
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="landingPageStyles.css">
</head>
<body>
    <?php
        include("navbar.php");
    
    ?>

    <div class="poster1-div">
        <img class="poster1" src="img/octaGlow_poster1.jpg">
    </div>

    <div class="poster2-div">
        <img class="poster2" src="img/octaGlow_poster2.jpg">
    </div>

  <!-- tickets-->
    <div id="tickets">
        <h4 class="ticket-header">TICKET SEATZONES</h4>
        
        <div class="ticket-section">
            <div class="vip">
                <img class ="seatzone-img" src="img/vip.jpg">
                <h3 class="setzone-txt">VIP</h3>
                <h3 class="setzone-txt">₱20,000.00</h3>
                <p>INCLUSIONS:</p>
                <ul>
                    <li>Exclusive backstage access</li>
                    <li>VIP lounge access</li>
                    <li>Two complimentary drinks </li>
                    <li>Limited Edition TShirt</li>
                    <li>Merchandise discount coupons</li>
                </ul>
                <button id="buy-btn" type="button" name="buy-btn" onclick="goToSeatzone()">Buy Ticket</button>
            </div>
            <div class="upper-box">
            <img class ="seatzone-img" src="img/upperbox.jpg">
                <h3 class="setzone-txt">Upper Box</h3>
                <h3 class="setzone-txt">₱15,000.00</h3>
                <p>INCLUSIONS:</p>
                <ul>
                    <li>One complimentary drink</li>
                    <li>Regular concert Tshirt</li>
                    <li>Merchandise discount coupons</li><br><br>
                </ul>
                <button id="buy-btn" type="button" name="buy-btn" onclick="goToSeatzone()">Buy Ticket</button>
            </div>
            <div class="lower-box">
            <img class ="seatzone-img" src="img/lowerbox.jpg">
                <h3 class="setzone-txt">Lower Box</h3>
                <h3 class="setzone-txt">₱10,000.00</h3>
                <p>INCLUSIONS:</p>
                <ul>
                    <li>Drink voucher</li>
                    <li>Regular concert Tshirt</li>
                    <li>Merchandise discount coupons</li><br><br>
                </ul>
                <button id="buy-btn" type="button" name="buy-btn" onclick="goToSeatzone()">Buy Ticket</button>
            </div>
            <div class="gen-ad">
            <img class ="seatzone-img" src="img/genad.jpg">
                <h3 class="setzone-txt">General Admission</h3>
                <h3 class="setzone-txt">₱5,000.00</h3>
                <p>INCLUSIONS:</p>
                <ul>
                    <li>Drink voucher</li>
                    <li>Merchandise discount coupons</li><br><br><br>
                </ul>
                <button id="buy-btn" type="button" name="buy-btn" onclick="goToSeatzone()">Buy Ticket</button>
            </div>
        </div>
    </div>
    <?php
        include("footer.php");
    ?>

</body>

</html>
<script>
    function goToSeatzone(){
        window.location.href = "Seatzone.php";
    }
</script>