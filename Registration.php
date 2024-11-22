<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Registration.css">
    <title>Registration</title>
</head>
<body>
    <section class="container">
        <header>Registration Form</header>
        <form class="form" method="POST">
            <div class="input-box">
                <label for="Fname">First Name</label>
                <input id="Fname" name="Fname" placeholder="Enter First Name" pattern="[A-Za-z ]+"  title="Please enter text only" type="text">
            </div>
            <div class="input-box">
                <label for="Lname">Last Name</label>
                <input id="Lname" name="Lname" placeholder="Enter Last Name" pattern="[A-Za-z ]+"  title="Please enter text only" type="text">
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input id="email" name="email" placeholder="Enter Email" type="email" required>
            </div>
            <div class="input-box">
                <label for="Pnum">Phone Number</label>
                <input id="Pnum" name="Pnum" placeholder="Enter phone number" type="tel">
            </div>
            <div class="input-box">
                <label for="bday">Birth Date</label>
                <input id="bday" name="bday" placeholder="dd/mm/yyyy" type="date" required>
            </div>
            <div class="gender-box"required>
                <label>Gender</label>
                <div class="gender-option">
                    <div class="gender">
                        <input id="male" name="gender" value="M" pattern="[A-Za-z ]+"  title="Please enter text only" type="radio">
                        <label for="male">Male</label>
                    </div>
                    <div class="gender">
                        <input id="female" name="gender" value="F" pattern="[A-Za-z ]+"  title="Please enter text only" type="radio">
                        <label for="female">Female</label>
                    </div>
                </div>
            </div>
            <div class="input-box">
                <label for="STaddress">Address</label>
                <input id="STaddress" name="STaddress" placeholder="Enter Street Address" type="text">
            </div>
            <div class="input-box">
                <label for="City">Region</label>
                <input id="City" name="City" placeholder="Enter your city" type="text">
            </div>
            <div class="input-box">
                <label for="Barangay">Barangay</label>
                <input id="Barangay" name="Barangay" placeholder="Enter your Barangay" type="text">
            </div>
            <div class="input-box">
                <label for="Zcode">Zipcode</label>
                <input id="Zcode" name="Zcode" placeholder="Enter your Zipcode" pattern="\d{4}" title="Please enter 4 digits number" type="text">
            </div>
            <div class="column">
                <div class="input-login">
                    <label for="Uname">Username</label>
                    <input id="Uname" name="Uname" placeholder="Enter your Username" type="text">
                </div>
                <div class="input-login">
                    <label for="Pword">Password</label>
                    <input id="Pword" name="Pword" placeholder="Enter your password" type="password">
                </div>
                <div class="input-login">
                    <label for="CPword">Confirm Password</label>
                    <input id="CPword" name="CPword" placeholder="Confirm your password" type="password">
                </div>
            </div>
            <button type="submit" name="regbtn">Submit</button>
            <div class="signup-link">
                <a href="index.php">Already have an account? Sign in</a>
            </div>
        </form>
    </section>
</body>
</html>


<?php
include("Connection.php");
if (isset($_POST["regbtn"])) {
    $Fname = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $Pnum = $_POST["Pnum"];

    $Birthdate = $_POST["bday"];
    $Email = $_POST["email"];
    $STaddress = $_POST["STaddress"];
    $Barangay = $_POST["Barangay"];
    $City = $_POST["City"];
    $Zcode = $_POST["Zcode"];
    $Username = $_POST["Uname"];
    $Gender = $_POST["gender"];
    $password = $_POST["Pword"];
    $ConfirmPword = $_POST["CPword"];
    $errors = array();

    // Validation
    if (empty($Fname) || empty($Lname) || empty($Pnum) || empty($Email) || empty($STaddress) || empty($Barangay) || empty($City) || empty($Zcode) || empty($Username) || empty($password) || empty($ConfirmPword)) {
        array_push($errors, "All Fields are required");
    }

    if (!preg_match('/^[0-9]{11}$/', $Pnum)) {
        array_push($errors, "Invalid Phone number");
    }

    if (strlen($Pnum) !== 11) {
        array_push($errors, "Phone Number must contain 11 Numbers");
    }

    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
        array_push($errors, "Password must be a minimum of 8 characters, contain at least 1 number, contain at least one lowercase character, contain at least one uppercase character");
    }

    if ($ConfirmPword !== $password) {
        array_push($errors, "Passwords do not match");
    }

    $select = "SELECT * FROM TB_BUYERS WHERE Username = '$Username'";
    $SelectResult = mysqli_query($con, $select);

    if (mysqli_num_rows($SelectResult) > 0) {
        array_push($errors, "The username you entered is already taken");
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
    }
     else {

      $sql = "INSERT INTO TB_BUYERS(BUYER_ID, FIRSTNAME, LASTNAME, BIRTHDATE, GENDER, PHONE, EMAIL_ADDRESS, STREET_ADDRESS, BARANGAY, CITY, ZIP_CODE, USERNAME, PASSWORD) VALUES ('', '$Fname', '$Lname', '$Birthdate', '$Gender', '$Pnum', '$Email', '$STaddress', '$Barangay', '$City', '$Zcode', '$Username', '$ConfirmPword')";
        mysqli_query($con, $sql);

        echo '<script type="text/javascript">window.location = "index.php";</script>';
  }
}
?>
