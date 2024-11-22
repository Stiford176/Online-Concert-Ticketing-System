<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="payment.css">

</head>
<body>
   
<?php
session_start();
include("Connection.php");
$CurrentUserID = $_SESSION['CurrentUserID'];
$Countquery = "SELECT 
SUM(CASE WHEN SEAT_ID LIKE 'GND%' THEN 1 ELSE 0 END) AS GENAD,
SUM(CASE WHEN SEAT_ID LIKE 'VIP%' THEN 1 ELSE 0 END) AS VIP,
SUM(CASE WHEN SEAT_ID LIKE 'UP%' THEN 1 ELSE 0 END) AS UP,
SUM(CASE WHEN SEAT_ID LIKE 'LB%' THEN 1 ELSE 0 END) AS LB
FROM TB_RESERVATIONS WHERE BUYER_ID = '$CurrentUserID';";
$count = mysqli_query($con, $Countquery);
$Countres = mysqli_fetch_array($count);
if ( $Countres['GENAD'] > 5) {
   echo '<script type="text/javascript">alert("You can only reserve up to 5 GenAd seats per account.");</script>';
   deleteUnpaid();
   echo '<script type="text/javascript">window.location = "Seatzone.php";</script>';
}
else if( $Countres['VIP'] > 5){
   echo '<script type="text/javascript">alert("You can only reserve up to 5 vip seats per account.");</script>';
   deleteUnpaid();
   echo '<script type="text/javascript">window.location = "Seatzone.php";</script>';
}
else if( $Countres['UP'] > 5){
   echo '<script type="text/javascript">alert("You can only reserve up to 5 vip seats per account.");</script>';
   deleteUnpaid();
   echo '<script type="text/javascript">window.location = "Seatzone.php";</script>';
}
else if( $Countres['LB'] > 5){
   echo '<script type="text/javascript">alert("You can only reserve up to 5 vip seats per account.");</script>';
   deleteUnpaid();
   echo '<script type="text/javascript">window.location = "Seatzone.php";</script>';
}
else {
   $Selectquery = "SELECT SEAT_ID, PRICE FROM TB_RESERVATIONS WHERE BUYER_ID = '$CurrentUserID' AND PAYMENT_STATUS = 'UNPAID'";
   $Selectres = mysqli_query($con, $Selectquery);
   $total = 0;
   
   while ($selectrow = mysqli_fetch_array($Selectres)) {
       echo "<div class='card'>";
       echo "<div class='title'>Payment Details</div>";
       echo "<div class='info'>";
       echo "<div class='row'>";
       echo "<div class='col-7'>";
       echo "<span id='heading'>Seat ID</span><br>";
       echo "<span id='details'>$selectrow[0]</span>";
       echo "</div>";
       echo "<div class='col-5 pull-right'>";
       echo "<span id='heading'>Concert Date</span><br>";
       echo "<span id='details'>December 09,2023</span>";
       echo "</div>";
       echo "</div>";
       echo "</div> ";
       echo "<div class='pricing'>";
       echo "<div class='row'>";
       echo "<div class='col-9'>";
       echo "<span id='heading'>Price</span><br>";
       echo "<span id='Price'>$selectrow[1]</span>";
       echo "</div>";
       echo "</div>";
       echo "</div>";
       echo "</div>";
       $total += $selectrow[1];
   }
   
   echo "<div class='total-container'>";
   echo "<div class='total'>";
   echo "<div class='row'>";
   echo "<div class='col-9'></div>";
   echo "<div class='col-3'>";
   echo "<span id='heading'>Total</span><br>";
   echo "<span id='Total'><big>&#8369;$total</big></span>";
   echo "</div>";
   echo "</div>";
   echo "</div>";
   echo "</div>";
}
function deleteUnpaid(){
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
}
?>

    
    
<form method = "POST">
   <div class="wrapper">
        <div class="card-switch">
            <label class="switch">
               <input type="checkbox" class="toggle">
               <span class="slider"></span>
               <span class="card-side"></span>
               <div class="flip-card__inner">
                  <div class="flip-card__front">
                     <div class="title">Gcash</div>
                     <form class="flip-card__form" method = "POST">
                        <input class="flip-card__input" name="name" id ="name" placeholder="Name" pattern="[A-Za-z ]+"  title="Please enter text only" type="name" required>
                        <input class="flip-card__input" name="Phonenumber" placeholder="Phone number" type="phone" title="Please enter Phone number correctly (Must be 11 digits/ No Text Allowed)" pattern="[0-9]{11}"required>
                        <button type = "submit" name= "checkout1" class="flip-card__btn">Checkout!</button>
                        <button type = "submit" name= "cancel1" class="flip-card__btn" onclick = "unreq()" >Cancel</button>
                     </form>
                  </div>
                  <div class="flip-card__back">
                     <div class="title">Credit Card</div>
                     <form class="flip-card__form" action="" method = "POST">
                        <input class="flip-card__input" name="Cname" placeholder="Credit Card Name" pattern="[A-Za-z ]+"  title="Please enter text only" type="Cname"required>
                        <input class="flip-card__input" name="ccnum" placeholder="Credit Card Number(First 8 digit)"  pattern="\d{8}" title="Please enter first 8 digits number" type="ccnum"required>
                        <input class="flip-card__input" name="expdate" placeholder="Exp Date(MM/YYYY)" pattern="\d{2}/\d{4}" title="Please enter a valid MM/YYYY format" type="expmonth"required>
                        <input class="flip-card__input" name="cvv" placeholder="CVV" pattern="\d{3}" title="Please enter 3 digits number" type="cvv"required>
                        <button type = "submit" name= "checkout2" class="flip-card__btn">Checkout!</button>
                        <button type = "submit" name= "cancel2" class="flip-card__btn" onclick = "unreq()">Cancel</button>
                     </form>
                  </div>
               </div>
            </label>
        </div>   
   </div>
</form>

<script>
   function unreq() {
            var inputElements = document.querySelectorAll('.flip-card__input');
            
            inputElements.forEach(function(element) {
                element.required = !element.required;
            });
        }
   </script>
    
</body>
</html>
<?php
include("Connection.php");


if (isset($_POST['checkout1']) || isset($_POST['checkout2'])) {
   $CurrentUserID = $_SESSION['CurrentUserID'];
   $QueryUpdate = "UPDATE TB_RESERVATIONS SET PAYMENT_STATUS = 'PAID' WHERE BUYER_ID = '$CurrentUserID'";
   $QueryUpdateRes = mysqli_query($con, $QueryUpdate);
  
         echo '<script type="text/javascript">alert("Reserved Sucessfully!");</script>';
         echo '<script type="text/javascript">window.location = "OrderDetails.php";</script>';
   
}
else if(isset($_POST['cancel1']) || isset($_POST['cancel2'])) {
    
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

echo '<script type="text/javascript">window.location = "landingPage.php";</script>';
exit();

}

?>