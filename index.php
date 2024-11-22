<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="Login.css">
    <title>Login</title>
  </head>
  <body>
  <div id="form-ui">
    <form action="" method="post" id="form">
      <div id="form-body">
    <div id="welcome-lines">
    <div class="form-ui">
    <div id="welcome-line-1">Get Your Tickets Now!</div>
      <div id="welcome-line-2">Don't Miss a Beat</div>
      <div class="form-inp">
        <input type="text" id="Uname" name="Uname" placeholder="Enter Username" required />
      </div>
      <div id="input-area">
      <div class="form-inp">
        <input type="password" id="Pword" name="Pword" placeholder="Enter password" required />
      </div>
      <button id="submit-button" type="submit" class="submit" name="loginbtn">Sign in</span></button><br>
      <a href="ForgotPassword.php" class="button3">Forgot password</a>
      <div id="forgot-pass">
      <a href="Registration.php">Don't have account? Sign up</a>
        </div>
        </div>
        <div id="bar"></div>
      </div>
    </form>
  </body>
</html>

<?php
session_start();
include("Connection.php"); 

if (isset($_POST["loginbtn"])) {
    $Username = $_POST['Uname'];
    $Password = $_POST['Pword'];

    $Command = "SELECT BUYER_ID, Username FROM TB_BUYERS WHERE Username = '$Username' AND Password = '$Password'";
    $Select = mysqli_query($con, $Command);
    $row = mysqli_fetch_array($Select);

    if ($row) {
        $_SESSION['CurrentUserID'] = $row['BUYER_ID']; 
        $_SESSION['Username'] = $row['USERNAME'];

        $commandSelect = "SELECT SEAT_ID FROM tb_reservations WHERE BUYER_ID = '{$_SESSION['CurrentUserID']}' AND PAYMENT_STATUS = 'UNPAID'";
        $Select = mysqli_query($con, $commandSelect);
        $Selectrow = mysqli_num_rows($Select);
      if($Selectrow >0 ){
        while ($Selectrow = mysqli_fetch_assoc($Select)) {
          $seatId = $Selectrow['SEAT_ID'];
          $CommandUpdate = "UPDATE TB_SEATS SET STATUS = 'AVAILABLE' WHERE SEAT_ID = '$seatId'";
          $Update = mysqli_query($con, $CommandUpdate);
      }
      $CommandDelete = "DELETE FROM tb_reservations WHERE BUYER_ID = '{$_SESSION['CurrentUserID']}' AND PAYMENT_STATUS = 'UNPAID' ";
      $Delete = mysqli_query($con, $CommandDelete);
      }
        header("Location: landingPage.php");
        exit();
    } else { //Admin Login
        $Command = "SELECT ADMIN_ID, USERNAME FROM TB_ADMIN WHERE USERNAME = '$Username' AND Password = '$Password'";
        $Select = mysqli_query($con, $Command);
        $row = mysqli_fetch_array($Select);

        if ($row) {
            $_SESSION['CurrentAdminID'] = $row['ADMIN_ID']; 
            $_SESSION['Username']= $row['USERNAME'];
            header("Location: adminPage.php");
            exit();
        } else {
            echo '<script type="text/javascript">alert("Invalid Username or Password Please Try Again");</script>';
        }
    }
}
?>
