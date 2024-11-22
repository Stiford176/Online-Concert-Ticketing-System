OrderDetails.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="OCTAOrderDetails.css">
    <title>Order Details</title>
</head>

<body>
    <?php
        include("navbar.php");
    ?>
    <?php
    session_start();
    include("Connection.php");

    $CurrentUserID = $_SESSION['CurrentUserID'];
    $Selectquery = "SELECT SEAT_ID,BUYER_ID, PRICE,BUYER_NAME, RESERVATION_DATE FROM TB_RESERVATIONS WHERE BUYER_ID = '$CurrentUserID' AND PAYMENT_STATUS = 'PAID'";
    $Selectres = mysqli_query($con, $Selectquery);
    echo"<div class='title'>Order Details</div>";
    while ($selectrow = mysqli_fetch_array($Selectres)) {
        
        echo"<div class='card'>";
        echo"<div class='  info'>";
            echo"<div class='row'>";
                echo"<div class='col-7'>";
                    echo"<span class='label'>Concert Name</span><br>";
                    echo"<span class='details'>OCTA - GLOW FEST NEON NIGHTS</span>";
                echo"</div>";
                echo"<div class='col-5'>";
                    echo"<span class='label'>Concert Date</span><br>";
                    echo"<span class='details'>December 09,2023</span>";
                echo"</div>";
                echo"<div class='col-5'>";
                    echo"<span class='label'>Seat ID</span><br>";
                    echo"<span class='details'>$selectrow[0]</span>";
                echo"</div>";
                echo"<div class='col-5'>";
                    echo"<span class='label'>Reservation Date</span><br>";
                    echo"<span class='details'>$selectrow[4]</span>";
                echo"</div>";
            echo"</div>";      
        echo"</div>";      
        echo"<div class='pricing'>";
            echo"<div class='row'>";
                echo"<div class='col-9'>";
                    echo"<span class='label'>Buyer ID</span><br>";
                    echo"<span class='details'>$selectrow[1]</span><br>";
                    echo"<span class='label'>Buyer Name</span><br>";
                    echo"<span class='details'>$selectrow[3]</span>";
                echo"</div>";
            echo"</div>";
        echo"</div>";
        echo"<div class='total'>";
        echo"<div class='row'>";
            echo"<div class='col-9'></div>";
            echo"<div class='col-3'>";
            echo"<span class='label'>Price</span><br>";
                echo"<span class='price'><big>&#8369;$selectrow[2]</big></span>";
            echo"</div>";
        echo"</div>";
    echo"</div>";
    echo"</div>";
    }
    
    ?>
    
</body>
<?php
        include("footer.php");
    ?>
</html>