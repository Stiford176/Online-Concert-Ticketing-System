<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
</head>
<body>
     <!-- nav bar-->
     <div>
        <nav class="navbar">

            <div class="left-div">
                <a href="landingPage.php#tickets" id="ticket-btn">TICKETS</a>
                <a href="OrderDetails.php" id="order-btn">ORDERS</a>
                <a href="Profile.php" id="profile-btn">PROFILE</a>
            </div>

                <a href="#" id="concertName"><span class="text-green">OCTA - GLOWFEST:</span> NEON NIGHTS</a>

            <div class="right-nav">
                <form method = "POST"action="index.php"><button id = "logout-btn" class="animated-buttons" type="submit">Logout</button></form> 
            </div>
        </nav>
    </div>
</body>
</html>

<style>
    @import url(https://use.fontawesome.com/releases/v6.4.2/css/all.css);

.left-nav{
    display: flex;
    margin-left: 5000x;
}

.navbar {
  box-sizing: border-box;
  font-family: Helvetica;
  scroll-behavior: smooth;
}

body {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.navbar {
  width: 100%;
  background-color: black;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  position: fixed;
  top: 0;
}

a {
  text-decoration: none;
  font-weight: 600;
  color: white;
  font-size: 14px;
  margin-right: 20px;
  transition: 0.8s;
}

.text-green {
  color: #00ff7f;
}

#concertName {
  font-weight: 800;
  font-size: 16px;
  text-align: center;
  margin-left: -100px;

}
#concertName span {
  margin-right: 10px;
  text-align: center;
}

button {
  position: relative;
  transition: 0.8s;
  cursor: pointer;
  overflow: hidden;
}

button::before {
  content: "";
  position: absolute;
  left: 0;
  width: 100%;
  height: 0%;
  background: #00ff7f;
  z-index: -1;
  transition: 0.8s;
}

#ticket-btn:hover, #profile-btn:hover, #order-btn:hover{
  color: #00ff7f;
}


.animated-buttons::before {
  content: "";
  position: absolute;
  left: 0;
  width: 100%;
  height: 0%;
  background: #00ff7f;
  z-index: -1;
  transition: 0.8s;
}

.animated-buttons {
  background: none;
  color: #00ff7f;
  border-radius: 20px;
  padding: 5px 20px;
  border: 2px solid #00ff7f;
  font-weight: 800px;
}

.animated-buttons::before {
  top: 0;
  border-radius: 0 0 50% 50%;
}

.animated-buttons:hover::before {
  height: 180%;
}

.animated-buttons:hover {
  color: black;
}
</style>