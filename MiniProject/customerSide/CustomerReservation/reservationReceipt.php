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
            $this->SetFont('Arial', 'B', 20);
            $this->Cell(0, 10, "Johnny's Restaurant", 0, 1, 'C');
            $this->SetFont('Arial', 'B', 16);
            $this->Ln();
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

    $pdf->Output();
} else {
    echo 'Invalid reservation ID or reservation not found.';
}
?>
