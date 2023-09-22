<?php
session_start(); // Ensure session is started
?>
<?php
require('fpdf186/fpdf.php');
require_once '../config.php';

$bill_id = $_GET['bill_id'];

// Fetch bill details
$bill_query = "SELECT * FROM Bills WHERE bill_id = '$bill_id'";
$bill_result = mysqli_query($link, $bill_query);
$bill_data = mysqli_fetch_assoc($bill_result);

// Fetch items for the given bill_id
$items_query = "SELECT bi.*, m.item_name, m.item_price FROM bill_items bi
                JOIN Menu m ON bi.item_id = m.item_id
                WHERE bi.bill_id = '$bill_id'";
$items_result = mysqli_query($link, $items_query);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Header
$pdf->Cell(0, 10, "Johnny's Restaurant", 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Receipt ID: ' . $bill_data['bill_id'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Date: ' . $bill_data['bill_time'], 0, 1, 'L');

// Display table, staff, and member IDs on the same row
$rowText = 'Table ID: ' . $bill_data['table_id'] . ' | Staff ID: ' . $bill_data['staff_id'] . ' | Member ID: ' . $bill_data['member_id'];
$pdf->Cell(0, 10, $rowText, 0, 1, 'L');

$paymentMethod = strtoupper($bill_data['payment_method']); // Capitalize payment method
$pdf->Cell(0, 10, 'Payment Method: ' . $paymentMethod, 0, 1, 'L');

// Display card number's last 4 digits for card payments
if ($paymentMethod === 'CARD') {
    $card_id = $bill_data['card_id'];
    $card_query = "SELECT card_number FROM card_payments WHERE card_id = '$card_id'";
    $card_result = mysqli_query($link, $card_query);
    $card_data = mysqli_fetch_assoc($card_result);
    $last4Digits = substr($card_data['card_number'], -4);
    $pdf->Cell(0, 10, 'Card Last 4 Digits: ' . $last4Digits, 0, 1, 'L');
}

// Retrieve payment time from the Bills table
$payment_time_query = "SELECT payment_time FROM Bills WHERE bill_id = '$bill_id'";
$payment_time_result = mysqli_query($link, $payment_time_query);
$payment_time = "";

if ($payment_time_result && mysqli_num_rows($payment_time_result) > 0) {
    $payment_time_row = mysqli_fetch_assoc($payment_time_result);
    $payment_time = $payment_time_row['payment_time'];
}

// Add the retrieved payment time to the PDF
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Payment Time: ' . $payment_time, 0, 1, 'L');



$pdf->Ln();

// Items
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 10, 'Item', 1);
$pdf->Cell(40, 10, 'Price', 1);
$pdf->Cell(40, 10, 'Quantity', 1);
$pdf->Cell(40, 10, 'Total', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
$cart_total = 0;
while ($item_row = mysqli_fetch_assoc($items_result)) {
    $item_name = $item_row['item_name'];
    $item_price = $item_row['item_price'];
    $quantity = $item_row['quantity'];
    $total = $item_price * $quantity;
    $cart_total += $total;

    $pdf->Cell(70, 10, $item_name, 1);
    $pdf->Cell(40, 10, 'RM ' . number_format($item_price,2), 1);
    $pdf->Cell(40, 10, $quantity, 1);
    $pdf->Cell(40, 10, 'RM ' . number_format($total,2), 1);
    $pdf->Ln();
}

$pdf->SetFont('Arial', 'B', 12);
$before_tax = $cart_total;
$tax_rate = 0.1;
$tax_amount = $before_tax * $tax_rate;
$after_tax = $before_tax + $tax_amount;

// Totals
$pdf->Cell(150, 10, 'Summary:', 0);
$pdf->Ln();
$pdf->Cell(150, 10, 'Total', 1);
$pdf->Cell(40, 10, 'RM ' . number_format($before_tax,2), 1);
$pdf->Ln();

$pdf->Cell(150, 10, 'Tax (' . ($tax_rate * 100) . '%)', 1);
$pdf->Cell(40, 10, 'RM ' . number_format($tax_amount,2), 1);
$pdf->Ln();

$pdf->Cell(150, 10, 'Grand Total', 1);
$pdf->Cell(40, 10, 'RM ' . number_format($after_tax,2), 1);
$pdf->Ln();

$pdf->Output('Receipt-Bill_ID-' . $bill_id . '.pdf', 'D');
?>
