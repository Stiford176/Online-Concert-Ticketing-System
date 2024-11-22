<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="Login.css">
    <title>Forgot Password</title>
  </head>
  <body>
  <div id="form-ui">
    <form method="POST" id="form">
      <div id="form-body">
    <div id="welcome-lines">
    <div class="form-ui">
    <div id="welcome-line-1">Trouble Logging In?</div>
      <div id="welcome-line-2">Forgot Password</div>
      <div class="form-inp">
        <input type="text" id="Uname" name="Uname" placeholder="Enter Username" required /> 
      </div>
      <br>
      <div class="form-inp">
        <input type="email" id="email" name="email" placeholder="Enter Email" required />
      </div>
      <div id="input-area">
      <div class="form-inp">
        <input type="password" id="Pword" name="Pword" placeholder="Enter New password" required />
      </div>
      <div id="input-area">
      <div class="form-inp">
        <input type="password" id="CPword" name="CPword" placeholder="Confirm password" required />
      </div>
      <button id="submit-button" type="submit" class="submit" name="resetpass">Reset password</span></button><br>
      <a href="Login.php" class="button3">Login</a>
        </div>
        </div>
        <div id="bar"></div>
      </div>
    </form>
  </body>
</html>
<?php
include("Connection.php");

if (isset($_POST["resetpass"])) {
  $Username = $_POST["Uname"];
  $Email = $_POST["email"];
  $NewPassword = $_POST["CPword"];
  $Password = $_POST["Pword"];
  $errors = array();

  // Validation
  if (empty($Username) || empty($Email) || empty($NewPassword)) {
    array_push($errors, "All fields are required.");
  }
  if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $Password)) {
    array_push($errors, "Password must be a minimum of 8 characters, contain at least 1 number, contain at least one lowercase character, contain at least one uppercase character");
  }
  if ($NewPassword !== $Password) {
    array_push($errors, "Passwords do not match");
  }

  if (count($errors) > 0) {
    foreach ($errors as $error) {
        echo "<div class='error'>";
        echo "<div class='error__icon'>";
        echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' viewBox='0 0 24 24' height='24' fill='none'><path fill='#393a37' d='m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z'></path></svg>";
        echo "</div>";
        echo "<div class='error__title'>$error</div>";
        echo "<div class='error__close' onclick='removeError(this)'><svg xmlns='http://www.w3.org/2000/svg' width='20' viewBox='0 0 20 20' height='20'><path fill='#393a37' d='m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z'></path></svg></div>";
        echo "</div><br>";
        echo '<script> function removeError(element) {
        var errorDiv = element.parentNode;
        errorDiv.parentNode.removeChild(errorDiv);
    }
</script>';
    }
} else {

    $Command = "SELECT * FROM TB_BUYERS WHERE USERNAME = '$Username' AND EMAIL_ADDRESS = '$Email'";
    $select = mysqli_query($con, $Command);

    // Check if the query was successful
    if ($select) {
      $SelectResult = mysqli_num_rows($select);

      if ($SelectResult == 0) {
        array_push($errors, "Invalid Username or Email. Please Try Again.");
      } else {
        // Update the password
        $Command = "UPDATE TB_BUYERS SET PASSWORD = '$NewPassword' WHERE USERNAME = '$Username' AND EMAIL_ADDRESS = '$Email'";
        $Update = mysqli_query($con, $Command);

        // Check if the update was successful
        if ($Update) {
          echo '<script type="text/javascript">alert("Password successfully changed.");</script>';
          header("location: index.php");
        } else {
          array_push($errors, "Password update failed.");
        }
      }
    } else {
      // Handle the case where the query fails
      array_push($errors, "Database error. Please try again later.");
    }
  }
}
?>



