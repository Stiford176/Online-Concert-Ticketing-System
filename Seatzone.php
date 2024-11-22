Seatzone.php
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="OCTASEATZONE.css">
</head>
<body>
   <?php
    include("navbar.php");
 
   ?>
    <div class="header">
        <h1>STAGE</h1>
    </div>
    <form method="post">
        <div class="seating-plan">
            <div class="seatzones">
                <div class="vip-seats">
                    <h3>VIP SEATZONE</h3>
                    <?php
                    session_start();
                    include("Connection.php");
                    $CurrentUserID = $_SESSION['CurrentUserID'];
                 
                    $commandSelect = "SELECT SEAT_ID FROM tb_reservations WHERE BUYER_ID = '$CurrentUserID' AND PAYMENT_STATUS = 'UNPAID'";
                    $Select = mysqli_query($con, $commandSelect);
                    
                    while ($Selectrow = mysqli_fetch_assoc($Select)) {
                        $seatId = $Selectrow['SEAT_ID'];
                        $CommandUpdate = "UPDATE TB_SEATS SET STATUS = 'AVAILABLE' WHERE SEAT_ID = '$seatId'";
                        $Update = mysqli_query($con, $CommandUpdate);
                    }
                    
                    $CommandDelete = "DELETE FROM tb_reservations WHERE BUYER_ID = '$CurrentUserID'AND PAYMENT_STATUS = 'UNPAID' ";
                    $Delete = mysqli_query($con, $CommandDelete);
                        displaySeats("VIP");
                    ?>
                </div>

                <div class="up-seats">
                <h3>UPPER BOX SEATZONE</h3>
                    <?php
                        displaySeats("UP");
                    ?>
                </div>

                <div class="lb-seats">
                <h3>LOWERBOX SEATZONE</h3>
                    <?php
                        displaySeats("LB");
                    ?>
                </div>

                <div class="genad-seats">
                <h3>GENERAL ADDMISSION SEATZONE</h3>
                    <?php
                        displaySeats("GND");
                    ?>
                </div>
            </div>
        </div>
        <button class="reserve-btn" type="submit" name="reservebtn" onclick="updateSeatCount()">Reserve Selected Seats</button>
    </form>
    <script>
    var selectedSeats = 0;

    function updateSeatCount() {
        var checkboxes = document.getElementsByName('seat[]');

        selectedSeats = 0;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedSeats++;
            }
        }

        // Limit selections to 5 seats
        if (selectedSeats > 5) {
            alert("You can only select up to 5 seats.");
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = false;
            }
            selectedSeats = 5; 
        }
        else if (selectedSeats <=0){
            alert("No seats selected, please select seats.");
        }
    }
</script>

</body>
<?php
    include("footer.php");
   ?>
</html>

<?php

function displaySeats($seatType)
{
    include("Connection.php");
    $Command = "SELECT SEAT_ID, PRICE, SEAT_TYPE, STATUS FROM TB_SEATS WHERE SEAT_TYPE = '$seatType' ORDER BY SEAT_ID ASC";
    $Select = mysqli_query($con, $Command);
    $row = mysqli_num_rows($Select);

    if ($row > 0) {

        while ($result = mysqli_fetch_assoc($Select)) {

            $seatId = $result['SEAT_ID'];
            $status = $result['STATUS'];
            $isTaken = $status === 'TAKEN';
            $checkboxStatus = $isTaken ? 'disabled' : '';
            $checkboxColor = $isTaken ? 'taken' : '';

            echo '<label for="checkbox" class="seat-label ' . $checkboxColor . '">
                    <input for="checkbox" type="checkbox" id="seat" name="seat[]" value="' . $seatId . '" ' . $checkboxStatus . ' onclick="updateSeatCount()">
                    ' . $seatId . '
                </label>';
        }
    } else {
        echo "No seats found in the database.";
    }
}

if (isset($_POST['reservebtn']) && !empty($_POST['seat'])) {
    include("Connection.php");
    $CurrentUserID = $_SESSION['CurrentUserID'];
$selectedSeats = $_POST['seat'];




if (count($selectedSeats) <= 0) {
        echo '<script type="text/javascript">alert("No seats were selected for reservation. Please Try Again");</script>';
    } else {
        $CurrentUserID = $_SESSION['CurrentUserID'];
        $selectedSeats = $_POST['seat'];

        $Command = "SELECT FIRSTNAME, LASTNAME FROM TB_BUYERS WHERE BUYER_ID = '$CurrentUserID'";
        $Select = mysqli_query($con, $Command);
        $row = mysqli_fetch_array($Select);

        if ($row) {
            $Buyer_Name = $row['FIRSTNAME'] . " " .$row['LASTNAME'];
            $Select->close();
        }

        // Update seat status in the 'seats' table
        $updateSeat = $con->prepare("UPDATE TB_SEATS SET status = 'TAKEN' WHERE SEAT_ID = ?");

        foreach ($selectedSeats as $seat) {

            // Retrieve the price for the selected seat
            $priceQuery = "SELECT PRICE FROM TB_SEATS WHERE SEAT_ID = '$seat'";
            $priceResult = mysqli_query($con, $priceQuery);
            $priceRow = mysqli_fetch_assoc($priceResult);
            $price = $priceRow['PRICE'];

            // Insert reservation into the 'reservations' table
            $Command = "INSERT INTO TB_RESERVATIONS (SEAT_ID, BUYER_ID, BUYER_NAME, PRICE) VALUES ('$seat', '$CurrentUserID', '$Buyer_Name', '$price')";
            $Insert = mysqli_query($con, $Command);

            // Update seat status for the selected seat
            $updateSeat->bind_param('s', $seat);
            $updateSeat->execute();
        }

        $updateSeat->close(); // Close the update query

        $con->close();
        echo '<script type="text/javascript">window.location = "Payment.php";</script>';
    }
}
?>
