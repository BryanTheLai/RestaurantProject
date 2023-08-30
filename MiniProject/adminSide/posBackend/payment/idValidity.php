<!DOCTYPE html>
<html>
<head>
    <title>Check Staff Member Reservation Validity</title>
</head>
<body>
    <h2>Check Staff Member Reservation Validity</h2>
    <form action="" method="post">
        <label for="staffId">Staff ID:</label>
        <input type="text" id="staffId" name="staffId" required>
        <br>
        <label for="memberId">Member ID:</label>
        <input type="text" id="memberId" name="memberId" >
        <br>
        <label for="reservationId">Reservation ID:</label>
        <input type="text" id="reservationId" name="reservationId" >
        <br>
        <button type="submit">Check Validity</button>
    </form>
</body>
</html>

<div>
    <?php
    // Include your database connection configuration
    require_once('../../config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $staffId = $_POST['staffId'];
        $memberId = !empty($_POST['memberId']) ? $_POST['memberId'] : 1;
        $reservationId = !empty($_POST['reservationId']) ? $_POST['reservationId'] : 1;
        $bill_id = $_GET['bill_id'];

        // Check if the staff ID exists in the database
        $query = "SELECT * FROM Staffs WHERE staff_id = '$staffId'";
        $result = mysqli_query($link, $query);

        if (!$result) {
            echo "Error: " . mysqli_error($link);
        } else {
            $staffExists = mysqli_num_rows($result) > 0;

            $memberExists = true; // Assume member is valid if ID is not provided
            if (!empty($memberId)) {
                $query = "SELECT * FROM Memberships WHERE member_id = '$memberId'";
                $result = mysqli_query($link, $query);
                if (!$result) {
                    echo "Error: " . mysqli_error($link);
                } else {
                    $memberExists = mysqli_num_rows($result) > 0;
                }
            }

            $reservationExists = true; // Assume reservation is valid if ID is not provided
            if (!empty($reservationId)) {
                $query = "SELECT * FROM Reservations WHERE reservation_id = '$reservationId'";
                $result = mysqli_query($link, $query);
                if (!$result) {
                    echo "Error: " . mysqli_error($link);
                } else {
                    $reservationExists = mysqli_num_rows($result) > 0;
                }
            }

            if ($staffExists && $memberExists && $reservationExists) {
                echo "Staff, member, and reservation are valid.";
                echo '<br><a href="../posCashPayment.php?bill_id=' . $bill_id . '&staff_id=' . $staffId . '&member_id=' . $memberId . '&reservation_id=' . $reservationId . '" class="btn btn-primary">Cash</a>';
                echo '<br><a href="../posCardPayment.php?bill_id=' . $bill_id . '&staff_id=' . $staffId . '&member_id=' . $memberId . '&reservation_id=' . $reservationId . '" class="btn btn-primary">Credit Card</a>';
            } else {
                echo "Invalid staff, member, or reservation.";
            }
        }
    }
    ?>
</div>
