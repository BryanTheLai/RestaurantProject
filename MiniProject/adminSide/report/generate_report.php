<?php
require('../posBackend/fpdf186/fpdf.php'); // Include the FPDF library
// Include your database configuration
require_once '../config.php';
function executeQuery($link, $sql) {
    $result = $link->query($sql);
    if ($result === false) {
        echo "Error: " . $link->error;
        return null;
    }
    return $result;
}

// Function to retrieve revenue breakdown by item category
// Function to retrieve revenue breakdown by item category
function getCategoryRevenue($link, $sql) {
    return executeQuery($link, $sql);
}
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 20);
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
        $w = array(90, 90);
        
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
    
    function CustomTableThreeColumn($header, $data)
    {
        $this->SetFont('Arial', 'B', 12);
        foreach ($header as $col) {
            $this->Cell(50, 10, $col, 1);
        }
        $this->Ln();

        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(50, 10, $col, 1);
            }
            $this->Ln();
        }
    }
    
    function CustomTableFourColumn($header, $data)
{
    $columnWidths = array(30, 40, 50, 70); // Adjust the column widths as needed

    $this->SetFont('Arial', 'B', 12);
    for ($i = 0; $i < count($header); $i++) {
        $this->Cell($columnWidths[$i], 10, $header[$i], 1);
    }
    $this->Ln();

    $this->SetFont('Arial', '', 12);
    foreach ($data as $row) {
        for ($i = 0; $i < count($row); $i++) {
            $this->Cell($columnWidths[$i], 10, $row[$i], 1);
        }
        $this->Ln();
    }
}

}

$pdf = new PDF();


$pdf->AddPage();

// Get monthly revenue breakdown 
$kitchenQuery = "SELECT 
    CONCAT(YEAR(time_ended), '-', LPAD(MONTH(time_ended), 2, '0')) AS year_and_month,
    COUNT(*) AS total_items_cooked,
    SUM(quantity) AS total_quantity,
    AVG(TIMESTAMPDIFF(MINUTE, time_submitted, time_ended)) AS average_cook_time
    
FROM 
    Kitchen
WHERE 
    YEAR(time_ended) = YEAR(NOW()) AND MONTH(time_ended) BETWEEN 1 AND 12
GROUP BY 
    YEAR(time_ended), MONTH(time_ended);
";

$kitchenResult = getCategoryRevenue($link, $kitchenQuery);
// Display the revenue breakdown by item category in a tabular format
$pdf->ChapterTitle('Kitchen Data Monthly');
$header = array('Month','Items Cooked' , 'Total Quantity', 'Average Cook Time in Minutes');
$data = array();
while ($row = mysqli_fetch_assoc($kitchenResult)) {
    $data[] = array($row['year_and_month'],$row['total_items_cooked'] , $row['total_quantity'], $row['average_cook_time']);
}
$pdf->CustomTableFourColumn($header, $data);


$pdf->Ln();





$pdf->Ln();

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

// Calculate total revenue for this year
$currentYear = date('Y');
$totalRevenueThisYearQuery = "SELECT SUM(item_price * quantity) AS total_revenue FROM Bill_Items
                             INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                             INNER JOIN Bills ON Bill_Items.bill_id = Bills.bill_id
                             WHERE YEAR(Bills.bill_time) = '$currentYear'";
$totalRevenueThisYearResult = mysqli_query($link, $totalRevenueThisYearQuery);

if (!$totalRevenueThisYearResult) {
    die("Query failed: " . mysqli_error($link));
}

$totalRevenueThisYearRow = mysqli_fetch_assoc($totalRevenueThisYearResult);
$totalRevenueThisYear = $totalRevenueThisYearRow['total_revenue'];

// Yearly Report
$pdf->ChapterTitle('Yearly Report');
$pdf->ChapterBody("Date Range: " . $currentYear . "-01-01 to " . $currentYear . "-12-31");
$pdf->ChapterBody("Total Revenue This Year: RM " . number_format($totalRevenueThisYear, 2));
$pdf->Ln();


$pdf->AddPage();
// Get daily revenue breakdown 
$dailySQL = "SELECT DATE(Bills.bill_time) AS date,DAY(Bills.bill_time) AS day, SUM(Bill_Items.quantity * Menu.item_price) AS daily_category_revenue
             FROM Bills
             JOIN Bill_Items ON Bills.bill_id = Bill_Items.bill_id
             JOIN Menu ON Bill_Items.item_id = Menu.item_id
             GROUP BY DATE(Bills.bill_time),DAY(Bills.bill_time)
             ORDER BY date DESC
             LIMIT 30";
$dailyCategoryRevenue = getCategoryRevenue($link, $dailySQL);
// Display the revenue breakdown by item category in a tabular format
$pdf->ChapterTitle('Daily Revenue Breakdown');
$header = array('Date','Day' , 'Revenue (RM)');
$data = array();
while ($row = mysqli_fetch_assoc($dailyCategoryRevenue)) {
    $data[] = array($row['date'], $row['day'], $row['daily_category_revenue']);
}
$pdf->CustomTableThreeColumn($header, $data);

$pdf->AddPage();
// Get weekly revenue breakdown 
$weeklySQL = "SELECT CONCAT(YEAR(Bills.bill_time), '-', MONTH(Bills.bill_time)) AS year, WEEK(Bills.bill_time) AS week, SUM(Bill_Items.quantity * Menu.item_price) AS weekly_category_revenue
              FROM Bills
              JOIN Bill_Items ON Bills.bill_id = Bill_Items.bill_id
              JOIN Menu ON Bill_Items.item_id = Menu.item_id
              GROUP BY YEAR(Bills.bill_time), WEEK(Bills.bill_time)
              ORDER BY year ASC
              LIMIT 15";
$weeklyCategoryRevenue = getCategoryRevenue($link, $weeklySQL);
// Display the revenue breakdown by item category in a tabular format
$pdf->ChapterTitle('Weekly Revenue Breakdown');
$header = array('Date','Week' , 'Revenue (RM)');
$data = array();
while ($row = mysqli_fetch_assoc($weeklyCategoryRevenue)) {
    $data[] = array($row['year'], $row['week'], $row['weekly_category_revenue']);
}
$pdf->CustomTableThreeColumn($header, $data);


$pdf->AddPage();
// Get monthly revenue breakdown 
$monthlySQL = "SELECT CONCAT(YEAR(Bills.bill_time), '-', MONTH(Bills.bill_time)) AS year, MONTH(Bills.bill_time) AS month, SUM(Bill_Items.quantity * Menu.item_price) AS monthly_category_revenue
               FROM Bills
               JOIN Bill_Items ON Bills.bill_id = Bill_Items.bill_id
               JOIN Menu ON Bill_Items.item_id = Menu.item_id
               GROUP BY YEAR(Bills.bill_time), MONTH(Bills.bill_time)
               ORDER BY year ASC
                LIMIT 15";
$monthlyCategoryRevenue = getCategoryRevenue($link, $monthlySQL);
// Display the revenue breakdown by item category in a tabular format
$pdf->ChapterTitle('Monthly Revenue Breakdown');
$header = array('Date','Month' , 'Revenue (RM)');
$data = array();
while ($row = mysqli_fetch_assoc($monthlyCategoryRevenue)) {
    $data[] = array($row['year'], $row['month'], $row['monthly_category_revenue']);
}
$pdf->CustomTableThreeColumn($header, $data);




$pdf->AddPage();
//CATEGORY



// Get daily revenue breakdown by item category
$dailySQL = "SELECT DATE(Bills.bill_time) AS date,DAY(Bills.bill_time) AS day ,Menu.item_category, SUM(Bill_Items.quantity * Menu.item_price) AS daily_category_revenue
             FROM Bills
             JOIN Bill_Items ON Bills.bill_id = Bill_Items.bill_id
             JOIN Menu ON Bill_Items.item_id = Menu.item_id
             GROUP BY DATE(Bills.bill_time),DAY(Bills.bill_time), Menu.item_category
             ORDER BY date DESC
             LIMIT 15";


// Get weekly revenue breakdown by item category
$weeklySQL = "SELECT CONCAT(YEAR(Bills.bill_time), '-', MONTH(Bills.bill_time)) AS year, WEEK(Bills.bill_time) AS week, Menu.item_category, SUM(Bill_Items.quantity * Menu.item_price) AS weekly_category_revenue
              FROM Bills
              JOIN Bill_Items ON Bills.bill_id = Bill_Items.bill_id
              JOIN Menu ON Bill_Items.item_id = Menu.item_id
              GROUP BY YEAR(Bills.bill_time), WEEK(Bills.bill_time), Menu.item_category
              ORDER BY year ASC
              LIMIT 15";


// Get monthly revenue breakdown by item category
$monthlySQL = "SELECT CONCAT(YEAR(Bills.bill_time), '-', MONTH(Bills.bill_time)) AS year, MONTH(Bills.bill_time) AS month, Menu.item_category, SUM(Bill_Items.quantity * Menu.item_price) AS monthly_category_revenue
               FROM Bills
               JOIN Bill_Items ON Bills.bill_id = Bill_Items.bill_id
               JOIN Menu ON Bill_Items.item_id = Menu.item_id
               GROUP BY YEAR(Bills.bill_time), MONTH(Bills.bill_time), Menu.item_category
               ORDER BY year ASC
                LIMIT 15";


// Get yearly revenue breakdown by item category
$yearlySQL = "SELECT YEAR(Bills.bill_time) AS year, Menu.item_category, SUM(Bill_Items.quantity * Menu.item_price) AS yearly_category_revenue
              FROM Bills
              JOIN Bill_Items ON Bills.bill_id = Bill_Items.bill_id
              JOIN Menu ON Bill_Items.item_id = Menu.item_id
              GROUP BY YEAR(Bills.bill_time), Menu.item_category
               ORDER BY year ASC
                LIMIT 15";


$dailyCategoryRevenue = getCategoryRevenue($link, $dailySQL);
$weeklyCategoryRevenue = getCategoryRevenue($link, $weeklySQL);
$monthlyCategoryRevenue = getCategoryRevenue($link, $monthlySQL);
$yearlyCategoryRevenue = getCategoryRevenue($link, $yearlySQL);




// Display the revenue breakdown by item category in a tabular format
$pdf->ChapterTitle('Daily Revenue Breakdown by Item Category');
$header = array('Date','Day' , 'Item Category', 'Revenue (RM)');
$data = array();
while ($row = mysqli_fetch_assoc($dailyCategoryRevenue)) {
    $data[] = array($row['date'], $row['day'], $row['item_category'], $row['daily_category_revenue']);
}
$pdf->CustomTableFourColumn($header, $data);


$pdf->AddPage();
$pdf->Ln();
// Display the revenue breakdown by item category in a tabular format
$pdf->ChapterTitle('Weekly Revenue Breakdown by Item Category');
$header = array('Date','Week' , 'Item Category', 'Revenue (RM)');
$data = array();
while ($row = mysqli_fetch_assoc($weeklyCategoryRevenue)) {
    $data[] = array($row['year'], $row['week'], $row['item_category'], $row['weekly_category_revenue']);
}
$pdf->CustomTableFourColumn($header, $data);
$pdf->Ln();

$pdf->AddPage();
// Display the revenue breakdown by item category in a tabular format
$pdf->ChapterTitle('Monthly Revenue Breakdown by Item Category');
$header = array('Date','Month' , 'Item Category', 'Revenue (RM)');
$data = array();
while ($row = mysqli_fetch_assoc($monthlyCategoryRevenue)) {
    $data[] = array($row['year'], $row['month'], $row['item_category'], $row['monthly_category_revenue']);
}
$pdf->CustomTableFourColumn($header, $data);

$pdf->AddPage();
// Display the revenue breakdown by item category in a tabular format
$pdf->ChapterTitle('Yearly Revenue Breakdown by Item Category');
$header = array('Date', 'Item Category', 'Revenue (RM)');
$data = array();
while ($row = mysqli_fetch_assoc($yearlyCategoryRevenue)) {
    $data[] = array($row['year'], $row['item_category'], $row['yearly_category_revenue']);
}
$pdf->CustomTableThreeColumn($header, $data);













$pdf->AddPage();
$pdf->Ln();
$currentMonthEnd = date('Y-m-t');  // Last day of the current month
$sortOrder = 'DESC';  // Default sort order

// Modify the SQL query for menu item sales to consider the current month
$menuItemSalesQuery = "SELECT Menu.item_name AS item_name, SUM(Bill_Items.quantity) AS total_quantity
                       FROM Bill_Items
                       INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                       INNER JOIN Bills ON Bill_Items.bill_id = Bills.bill_id
                       WHERE Bills.bill_time BETWEEN '$currentMonthStart 00:00:00' AND '$currentMonthEnd 23:59:59'
                       GROUP BY item_name
                       ORDER BY total_quantity $sortOrder
                       LIMIT 10";


$menuItemSalesResult = mysqli_query($link, $menuItemSalesQuery);

$menuItemSalesResultData = array();
while ($row = mysqli_fetch_assoc($menuItemSalesResult)) {
    $menuItemSalesResultData[] = array($row['item_name'], $row['total_quantity']);
}
$pdf->ChapterBody("10 Most Ordered Items this Month ( "  . $currentMonthStart . " - " . $currentMonthEnd . " ) :\n");
$pdf->CustomTable(array('Category', 'Quantity'), $menuItemSalesResultData);
$sortOrder = 'ASC';  // Default sort order
// Modify the SQL query for menu item sales to consider the current month
$menuItemSalesLeastQuery = "SELECT Menu.item_name AS item_name, SUM(Bill_Items.quantity) AS total_quantity
                       FROM Bill_Items
                       INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                       INNER JOIN Bills ON Bill_Items.bill_id = Bills.bill_id
                       WHERE Bills.bill_time BETWEEN '$currentMonthStart 00:00:00' AND '$currentMonthEnd 23:59:59'
                       GROUP BY item_name
                       ORDER BY total_quantity $sortOrder
                       LIMIT 10";


$menuItemSalesLeastResult = mysqli_query($link, $menuItemSalesLeastQuery);
$pdf->AddPage();
$menuItemSalesLeastResultData = array();
while ($row = mysqli_fetch_assoc($menuItemSalesLeastResult)) {
    $menuItemSalesLeastResultData[] = array($row['item_name'], $row['total_quantity']);
}
$pdf->Ln();
$pdf->ChapterBody("10 Least Ordered Items this Month ( "  . $currentMonthStart . " - " . $currentMonthEnd . " ) :\n");
$pdf->CustomTable(array('Category', 'Quantity'), $menuItemSalesLeastResultData);
$pdf->AddPage();
//not ordered
$menuItemNoOrdersQuery = "SELECT
    Menu.item_name,
    0 AS total_quantity
FROM
    Menu
WHERE NOT EXISTS (
    SELECT 1
    FROM Bill_Items
    WHERE Menu.item_id = Bill_Items.item_id
);

";


$menuItemNoOrdersResult = mysqli_query($link, $menuItemNoOrdersQuery);

$menuItemNoOrdersResultData = array();
while ($row = mysqli_fetch_assoc($menuItemNoOrdersResult)) {
    $menuItemNoOrdersResultData[] = array($row['item_name'], $row['total_quantity']);
}
$pdf->Ln();
$pdf->ChapterBody("All Items with no Orders this Month ( "  . $currentMonthStart . " - " . $currentMonthEnd . " ) :\n");
$pdf->CustomTable(array('Category', 'Quantity'), $menuItemNoOrdersResultData);


$pdf->Output('RevenueReport.pdf', 'D');
?>
