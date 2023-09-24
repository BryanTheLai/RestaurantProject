<?php
require('../../adminSide/posBackend/fpdf186/fpdf.php');
require_once '../../adminSide/config.php';

$reservation_id = $_GET['reservation_id'] ?? 1;

// Function to fetch reservation information by reservation ID
function getReservationInfoById($link, $reservation_id) {
    $query = "SELECT * FROM Reservations WHERE reservation_id='$reservation_id'";
    $result = mysqli_query($link, $query);

    if ($result) {
        $reservationInfo = mysqli_fetch_assoc($result);
        return $reservationInfo;
    } else {
        return null;
    }
}

// Fetch reservation information based on the reservation ID
$reservationInfo = getReservationInfoById($link, $reservation_id);

if ($reservationInfo) {
    // Create a PDF using FPDF
    class PDF extends FPDF {
        function Header() {
            // Set font and size for the logo text
            $this->SetFont('Arial', 'B', 20);

            // Create the logo text
            $logoText = "JOHNNY'S DINING & BAR";
            
            // Add a link-like style (you cannot create actual HTML links in PDF)
            $this->SetTextColor(0, 0, 0); // Set the text color to blue
            $this->Cell(0, 10, $logoText, 0, 1, 'C', false, 'http://localhost/RestaurantProject/customerSide/home/home.php#hero');

            $this->SetTextColor(0); // Reset text color to default

            // Add space
            $this->Ln(10);

            // Set font and size for "Reservation Information" text
            $this->SetFont('Arial', 'B', 16);
            $this->Cell(0, 10, 'Reservation Information', 1, 1, 'C');
        }
    }


    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    // Create a table for reservation information
    $pdf->Cell(40, 10, 'Reservation ID:', 1);
    $pdf->Cell(150, 10, $reservationInfo['reservation_id'], 1);
    $pdf->Ln();

    $pdf->Cell(40, 10, 'Customer Name:', 1);
    $pdf->Cell(150, 10, $reservationInfo['customer_name'], 1);
    $pdf->Ln();

    $pdf->Cell(40, 10, 'Table ID:', 1);
    $pdf->Cell(150, 10, $reservationInfo['table_id'], 1);
    $pdf->Ln();

    $pdf->Cell(40, 10, 'Reservation Time:', 1);
    $pdf->Cell(150, 10, $reservationInfo['reservation_time'], 1);
    $pdf->Ln();

    $pdf->Cell(40, 10, 'Reservation Date:', 1);
    $pdf->Cell(150, 10, $reservationInfo['reservation_date'], 1);
    $pdf->Ln();

    $pdf->Cell(40, 10, 'Head Count:', 1);
    $pdf->Cell(150, 10, $reservationInfo['head_count'], 1);
    $pdf->Ln();

    $pdf->Cell(40, 10, 'Special Request:', 1);
    $pdf->Cell(150, 10, $reservationInfo['special_request'], 1);
    $pdf->Ln();
    
    
    $pdf->Output('Reservation-Copy-ID' . $reservationInfo['reservation_id'] . '.pdf', 'D');
} else {
    echo 'Invalid reservation ID or reservation not found.';
}
?>
