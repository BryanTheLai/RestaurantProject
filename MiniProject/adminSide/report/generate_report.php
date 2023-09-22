<?php
require('../posBackend/fpdf186/fpdf.php'); // Include the FPDF library
// Include your database configuration
require_once '../config.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, "Johnny's Dining & Bar Report", 0, 1, 'C');
        $this->Ln(6); // Decreased spacing here
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function ChapterTitle($title)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $title, 0, 1, 'L');
        $this->Ln(2); // Decreased spacing here
    }

    function ChapterBody($body)
    {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 6, $body); // Decreased line height here
        $this->Ln(2); // Decreased spacing here
    }

    function CustomTable($header, $data)
    {
        // Column widths
        $w = array(60, 60);
        
        // Header
        $this->SetFillColor(200, 200, 200);
        $this->SetFont('Arial', 'B');
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();
        
        // Data
        $this->SetFont('Arial', '');
        foreach ($data as $row) {
            for ($i = 0; $i < count($row); $i++) {
                $this->Cell($w[$i], 10, $row[$i], 1);
            }
            $this->Ln();
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Set the current date
$currentDate = date('Y-m-d');

// Calculate total revenue for today
$totalRevenueTodayQuery = "SELECT SUM(item_price * quantity) AS total_revenue FROM Bill_Items
                        INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                        INNER JOIN Bills ON Bill_Items.bill_id = Bills.bill_id
                        WHERE DATE(Bills.bill_time) = '$currentDate'";
$totalRevenueTodayResult = mysqli_query($link, $totalRevenueTodayQuery);

if (!$totalRevenueTodayResult) {
    die("Query failed: " . mysqli_error($link));
}

$totalRevenueTodayRow = mysqli_fetch_assoc($totalRevenueTodayResult);
$totalRevenueToday = $totalRevenueTodayRow['total_revenue'];

// Comment out or remove the debugging echo statement
// echo "Total Revenue Today: " . $totalRevenueToday;

// Daily Report
$pdf->ChapterTitle('Daily Report');
$pdf->ChapterBody("Date: " . date('Y-m-d') . "\n");
$pdf->ChapterBody("Total Revenue Today: RM " . number_format($totalRevenueToday, 2));
$pdf->Ln();

// Calculate total revenue for this week (assuming week starts on Monday)
$currentWeekStart = date('Y-m-d', strtotime('monday this week'));
$totalRevenueThisWeekQuery = "SELECT SUM(item_price * quantity) AS total_revenue FROM Bill_Items
                             INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                             INNER JOIN Bills ON Bill_Items.bill_id = Bills.bill_id
                             WHERE DATE(Bills.bill_time) >= '$currentWeekStart'";
$totalRevenueThisWeekResult = mysqli_query($link, $totalRevenueThisWeekQuery);

if (!$totalRevenueThisWeekResult) {
    die("Query failed: " . mysqli_error($link));
}

$totalRevenueThisWeekRow = mysqli_fetch_assoc($totalRevenueThisWeekResult);
$totalRevenueThisWeek = $totalRevenueThisWeekRow['total_revenue'];

// Weekly Report
$pdf->ChapterTitle('Weekly Report');
$pdf->ChapterBody("Date Range: " . $currentWeekStart . " to " . date('Y-m-d'));
$pdf->ChapterBody("Total Revenue This Week: RM " . number_format($totalRevenueThisWeek, 2));
$pdf->Ln();

// Calculate total revenue for this month
$currentMonthStart = date('Y-m-01');
$totalRevenueThisMonthQuery = "SELECT SUM(item_price * quantity) AS total_revenue FROM Bill_Items
                              INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                              INNER JOIN Bills ON Bill_Items.bill_id = Bills.bill_id
                              WHERE DATE(Bills.bill_time) >= '$currentMonthStart'";
$totalRevenueThisMonthResult = mysqli_query($link, $totalRevenueThisMonthQuery);

if (!$totalRevenueThisMonthResult) {
    die("Query failed: " . mysqli_error($link));
}

$totalRevenueThisMonthRow = mysqli_fetch_assoc($totalRevenueThisMonthResult);
$totalRevenueThisMonth = $totalRevenueThisMonthRow['total_revenue'];

// Monthly Report
$pdf->ChapterTitle('Monthly Report');
$pdf->ChapterBody("Date Range: " . $currentMonthStart . " to " . date('Y-m-t'));
$pdf->ChapterBody("Total Revenue This Month: RM " . number_format($totalRevenueThisMonth, 2));
$pdf->Ln();

// Calculate total revenue by category for today, this week, and this month
$categoryRevenueTodayQuery = "SELECT item_category, SUM(item_price * quantity) AS category_revenue
                              FROM Bill_Items
                              INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                              INNER JOIN Bills ON Bill_Items.bill_id = Bills.bill_id
                              WHERE DATE(Bills.bill_time) = '$currentDate'
                              GROUP BY item_category";
$categoryRevenueWeekQuery = "SELECT item_category, SUM(item_price * quantity) AS category_revenue
                             FROM Bill_Items
                             INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                             INNER JOIN Bills ON Bill_Items.bill_id = Bills.bill_id
                             WHERE DATE(Bills.bill_time) >= '$currentWeekStart'
                             GROUP BY item_category";
$categoryRevenueMonthQuery = "SELECT item_category, SUM(item_price * quantity) AS category_revenue
                              FROM Bill_Items
                              INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                              INNER JOIN Bills ON Bill_Items.bill_id = Bills.bill_id
                              WHERE DATE(Bills.bill_time) >= '$currentMonthStart'
                              GROUP BY item_category";

$categoryRevenueTodayResult = mysqli_query($link, $categoryRevenueTodayQuery);
$categoryRevenueWeekResult = mysqli_query($link, $categoryRevenueWeekQuery);
$categoryRevenueMonthResult = mysqli_query($link, $categoryRevenueMonthQuery);
$pdf->AddPage();
// Category-wise Reports
$pdf->ChapterTitle('Category-wise Reports');
$pdf->ChapterBody("Date: " . date('Y-m-d') . "\n");

// Create data arrays for category tables
$categoryTodayData = array();
$categoryWeekData = array();
$categoryMonthData = array();

while ($row = mysqli_fetch_assoc($categoryRevenueTodayResult)) {
    $categoryTodayData[] = array($row['item_category'], "RM " . number_format($row['category_revenue'], 2));
}

while ($row = mysqli_fetch_assoc($categoryRevenueWeekResult)) {
    $categoryWeekData[] = array($row['item_category'], "RM " . number_format($row['category_revenue'], 2));
}

while ($row = mysqli_fetch_assoc($categoryRevenueMonthResult)) {
    $categoryMonthData[] = array($row['item_category'], "RM " . number_format($row['category_revenue'], 2));
}



// Create category tables
$pdf->ChapterBody("\nTotal Revenue by Category This Today:\n");
$pdf->CustomTable(array('Category', 'Revenue (RM)'), $categoryTodayData);
$pdf->ChapterBody("\nTotal Revenue by Category This Week:\n");
$pdf->CustomTable(array('Category', 'Revenue (RM)'), $categoryWeekData);
$pdf->ChapterBody("\nTotal Revenue by Category This Month:\n");
$pdf->CustomTable(array('Category', 'Revenue (RM)'), $categoryMonthData);

$pdf->Ln();

$pdf->Output('RevenueReport.pdf', 'D');
?>
