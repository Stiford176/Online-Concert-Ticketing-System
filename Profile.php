Profile.php
<!DOCTYPE html>
<?php
session_start();
include("Connection.php");
if (isset($_SESSION['CurrentUserID'])) {
    $CurrentUserID = $_SESSION['CurrentUserID'];
    $Command = "SELECT * FROM TB_BUYERS WHERE BUYER_ID = '$CurrentUserID'";
    $Select = mysqli_query($con, $Command);
    $row = mysqli_fetch_array($Select);

    if ($row)
    {
        $Username = $row['USERNAME'];
        $Firstname = $row['FIRSTNAME'];
        $Lastname = $row['LASTNAME'];
        $Phone = $row['PHONE'];
        $Birthdate = $row['BIRTHDATE'];
        $Gender = $row['GENDER'];
        $EmailAddress = $row['EMAIL_ADDRESS'];
        $StreetAddress = $row['STREET_ADDRESS'];
        $BARANGAY = $row['BARANGAY'];
        $CITY = $row['CITY'];
        $ZIP_CODE = $row['ZIP_CODE'];
        if ($Gender == "M") {
            $Gender = "MALE";
        }
        else{
            $Gender = "FEMALE";
        }
    }

}

    
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCOUNT SETTINGS</title>
    <link rel="stylesheet" href="OCTAPROFILE.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php
        include("navbar.php");
    ?>

    <form method = "POST">
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                <div class="tab-content">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">Change password</a>
                      
                    </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                    <div class="tab-pane fade active show" id="account-general">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label">Username</label>
                                    <input id ="USRN" name ="USRN" type="text" class="form-control mb-1" value = "<?php echo $Username ?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input id ="FN" name ="FN" type="text" class="form-control" value = "<?php echo $Firstname ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input id ="LN" name ="LN" type="text" class="form-control mb-1" value = "<?php echo $Lastname ?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input id ="Eaddress" name ="Eaddress" type="text" class="form-control" value = "<?php echo $EmailAddress ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label">Street Address</label>
                                    <input id ="Saddress" name ="Saddress" type="text" class="form-control" value = "<?php echo $StreetAddress ?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Barangay</label>
                                    <input id ="Brgy" name ="Brgy" type="text" class="form-control" value = "<?php echo $BARANGAY ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input  id ="Cty" name ="Cty" type="text" class="form-control" value = "<?php echo $CITY ?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Zipcode</label>
                                    <input id ="Zcode" name ="Zcode" type="text" class="form-control" value = "<?php echo $ZIP_CODE ?>" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label">Birthday</label>
                                    <input id ="bday" name ="bday" type="date" class="form-control" value = "<?php echo $Birthdate ?>" disabled >
                                </div>
                                <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                    <select id = "gender" name ="gender" class="custom-select" disabled>
                                        <option value = "M" <?php if ($Gender == "MALE") echo "selected"; ?>>MALE</option>
                                        <option value = "F"  <?php if ($Gender == "FEMALE") echo "selected"; ?>>FEMALE</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label">Phone number</label>
                                    <input id ="CPNumber"  name ="CPNumber" type="text" class="form-control" value = "<?php echo $Phone ?>" disabled>
                                </div>
                            </div>
                            <div class="text-right mt-3">
                            <button type="button" id = "Editbtn" class="btn btn-primary" onclick="enableButton()">Edit Details</button>&nbsp;
                            <button type="submit" id = "SaveChangesBtn" name = "SaveChangesBtn" class="btn btn-primary" disabled>Save Details</button>&nbsp;
                            </div>
                        </div>
                    </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Current password</label>
                                    <input id ="Pword"  name ="Pword" type="password" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">New password</label>
                                    <input id ="Npword" name ="Npword" type="password" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm new password</label>
                                    <input id ="CNPword" name ="CNPword" type="password" class="form-control" disabled>
                                </div>
                                <button type="button" id = "changpassbtn" class="btn btn-primary" onclick="Changepassword()">Change Password</button>&nbsp;
                                <button type="Submit" id = "Savepassbtn" name = "Savepassbtn" class="btn btn-primary" disabled>Save Password</button>&nbsp;
                            </div>
                            
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mt-3">
            
          
            <button type="button" id = "Cancelbtn" name = "Cancelbtn"class="btn btn-cancel disabled-button" onclick="disableButton()" disabled>Cancel</button>
        </div>
    </div>
   
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Function-->
    <script>
        function enableButton(){
            document.getElementById("SaveChangesBtn").disabled = false
            document.getElementById("Cancelbtn").disabled = false
            document.getElementById("USRN").disabled = false
            document.getElementById("FN").disabled = false
            document.getElementById("LN").disabled = false
            document.getElementById("Eaddress").disabled = false
            document.getElementById("Saddress").disabled = false
            document.getElementById("Brgy").disabled = false
            document.getElementById("gender").disabled = false
            document.getElementById("Cty").disabled = false
            document.getElementById("Zcode").disabled = false
            document.getElementById("Pword").disabled = false
            document.getElementById("Npword").disabled = false
            document.getElementById("CNPword").disabled = false
            document.getElementById("CPNumber").disabled = false
        }
        function disableButton(){
            document.getElementById("SaveChangesBtn").disabled = true
            document.getElementById("Cancelbtn").disabled = true
            document.getElementById("USRN").disabled = true
            document.getElementById("FN").disabled = true
            document.getElementById("LN").disabled = true
            document.getElementById("Eaddress").disabled = true
            document.getElementById("Saddress").disabled = true
            document.getElementById("Brgy").disabled = true
            document.getElementById("Cty").disabled = true
            document.getElementById("Zcode").disabled = true
            document.getElementById("Pword").disabled = true
            document.getElementById("Npword").disabled = true
            document.getElementById("CNPword").disabled = true
            document.getElementById("CPNumber").disabled = true
            document.getElementById("gender").disabled = true
            location.reload();
        }
        function Changepassword(){
            document.getElementById("Pword").disabled = false
            document.getElementById("Npword").disabled = false
            document.getElementById("CNPword").disabled = false
            document.getElementById("Savepassbtn").disabled = 
            document.getElementById("Cancelbtn").disabled = false
           
        }
        </script>
            </form>
       
</html>
<?php 
include("Connection.php");


if (isset($_POST['SaveChangesBtn'])) {
    $CurrentUserID = $_SESSION['CurrentUserID'];
    $USRN = $_POST["USRN"];
    $FN = $_POST["FN"];
    $LN = $_POST["LN"];
    $CPNumber = $_POST["CPNumber"];
    $Gendr = $_POST["gender"];
    $Eaddress = $_POST["Eaddress"];
    $Saddress = $_POST["Saddress"];
    $Brgy = $_POST["Brgy"];
    $Cty = $_POST["Cty"];
    $Zcode = $_POST["Zcode"];

    $Command = "UPDATE TB_BUYERS SET USERNAME = '$USRN', FIRSTNAME = '$FN', LASTNAME = '$LN', PHONE = '$CPNumber', GENDER = '$Gendr', EMAIL_ADDRESS = '$Eaddress', STREET_ADDRESS = '$Saddress', BARANGAY = '$Brgy', CITY = '$Cty', ZIP_CODE = '$Zcode' WHERE BUYER_ID = '$CurrentUserID'";
    $Update = mysqli_query($con, $Command);
    $Updaterow = mysqli_num_rows($Select);

    if ($Updaterow) {
        echo '<script type="text/javascript">window.location = "Profile.php";</script>';
        
    } else {
        echo "Error";
    }
}
if (isset($_POST['Savepassbtn'])) {
    $CurrentUserID = $_SESSION['CurrentUserID'];
    $CurrentPassword = $_POST["Pword"];
    $NewPassword = $_POST["Npword"];
    $ConfirmNewPassword = $_POST["CNPword"];
    $errors = array();

    // Check if the current password is correct
    $select = "SELECT PASSWORD FROM TB_BUYERS WHERE BUYER_ID = ? LIMIT 1";
    $stmt = mysqli_prepare($con, $select);
    mysqli_stmt_bind_param($stmt, "s", $CurrentUserID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $storedCurrentPassword = $row['PASSWORD'];

        if ($CurrentPassword !== $storedCurrentPassword) {
            array_push($errors, "Invalid Current Password. Please Try Again.");
        }
    } else {
        array_push($errors, "Invalid Current Password. Please Try Again.");
    }

    if (empty($CurrentPassword) || empty($NewPassword) || empty($ConfirmNewPassword)) {
        array_push($errors, "All fields are required.");
    }

    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $NewPassword)) {
        array_push($errors, "Password must be a minimum of 8 characters, contain at least 1 number, contain at least one lowercase character, contain at least one uppercase character");
    }

    if ($NewPassword !== $ConfirmNewPassword) {
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
        // Update the password
        $Update = "UPDATE TB_BUYERS SET PASSWORD = ? WHERE BUYER_ID = ?";
        $stmt = mysqli_prepare($con, $Update);
        mysqli_stmt_bind_param($stmt, "ss", $ConfirmNewPassword, $CurrentUserID);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script type="text/javascript">alert("Password successfully changed.");</script>';
        } else {
            array_push($errors, "Password update failed.");
        }
    }
}

?>

