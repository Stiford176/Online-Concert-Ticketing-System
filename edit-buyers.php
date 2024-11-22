<?php
    session_start();
    include("connection.php");

    $buyerId = $_GET['id1'];

    $query = "SELECT* FROM tb_buyers WHERE BUYER_ID = '$buyerId'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) >0) 
    { 
        while($row = mysqli_fetch_assoc($query_run)) 
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
            $password = $row['PASSWORD'];
        } 
    }
    
    else{
        echo '<script>alert("no data found")</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit</title>
  </head>

  <body>
    
  <section class="container">
        <header>Edit Information</header>
        <form class="form" method="POST">
            <div class="input-box">
                <label for="Fname">First Name</label>
                <input id="Fname" name="Fname" value="<?php echo $Firstname?>" type="text">
            </div>
            <div class="input-box">
                <label for="Lname">Last Name</label>
                <input id="Lname" name="Lname" value="<?php echo $Lastname?>" type="text">
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input id="email" name="email" value="<?php echo $EmailAddress?>" type="email">
            </div>
            <div class="input-box">
                <label for="Pnum">Phone Number</label>
                <input id="Pnum" name="Pnum" value="<?php echo $Phone?>" type="tel">
            </div>
            <div class="input-box">
                <label for="bday">Birth Date</label>
                <input id="bday" name="bday" value="<?php echo $Birthdate?>" type="date" required>
            </div>

            <div class="input-box">
                <label for="gender">Gender</label>
                <input id="gender" name="gender" value="<?php echo $Gender?>" type="text" required>
            </div>

            <div class="input-box">
                <label for="STaddress">Address</label>
                <input id="STaddress" name="STaddress" value="<?php echo $StreetAddress?>" type="text">
            </div>
            <div class="input-box">
                <label for="City">City</label>
                <input id="City" name="City" value="<?php echo $CITY?>" type="text">
            </div>
            <div class="input-box">
                <label for="Barangay">Barangay</label>
                <input id="Barangay" name="Barangay" value="<?php echo $BARANGAY?>" type="text">
            </div>
            <div class="input-box">
                <label for="Zcode">Zipcode</label>
                <input id="Zcode" name="Zcode" value="<?php echo $ZIP_CODE?>" type="text">
            </div>

            <div class="input-box">
                <label for="Uname">Username</label>
                <input id="Uname" name="Uname" value="<?php echo $Username?>" type="text">
            </div>
            <div class="input-box">
                <label for="Pword">Password</label>
                    <input id="Pword" name="Pword" value="<?php echo $password?>" type="password">
            </div>
            <div class="buttons">
                <button type="submit" name="save-btn">Save Changes</button>
                <button type="button" name="back-btn" onclick="history.back()">Back</btn>               
            </div>
        </form>
    </section>
  </body>
</html>

<?php
    if(isset($_POST['save-btn']))
    {

        $USRN = $_POST["Uname"];
        $FN = $_POST["Fname"];
        $LN = $_POST["Lname"];
        $CPNumber = $_POST["Pnum"];
        $Gendr = $_POST["gender"];
        $Eaddress = $_POST["email"];
        $Saddress = $_POST["STaddress"];
        $Brgy = $_POST["Barangay"];
        $Cty = $_POST["City"];
        $Zcode = $_POST["Zcode"];
        $bdate = $_POST['bday'];
        $password = $_POST['Pword'];
    
        $Update = "UPDATE TB_BUYERS SET USERNAME = ?, FIRSTNAME = ?, LASTNAME = ?, PHONE = ?, GENDER = ?, EMAIL_ADDRESS = ?, STREET_ADDRESS = ?, BARANGAY = ?, CITY = ?, ZIP_CODE = ?, PASSWORD = ?, BIRTHDATE = ? WHERE BUYER_ID = ?";
        $stmt = mysqli_prepare($con, $Update);
        mysqli_stmt_bind_param($stmt, "ssssssssssssi", $USRN, $FN, $LN, $CPNumber, $Gendr, $Eaddress, $Saddress, $Brgy, $Cty, $Zcode, $password, $bdate, $buyerId);
    
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Changes has been saved")</script>';
            echo '<script type="text/javascript">window.location = "buyersTable.php";</script>';
            
        } else {
            echo "Error";
        }           
    }
?>

<style>
.container {
  position: relative;
  max-width: 1200px;
  width: 100%;
  background: #161616;
  padding: 50px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  margin: 0 auto;
  text-align: center;
}

.container header {
  font-size: 1.5rem;
  color: #00ff7f;
  font-weight: 600;
  text-align: center;
}

.container .form {
  display: flex;
  flex-wrap: wrap;
  column-gap: 90px;
}

.form .input-box,
.input-login {
  width: 45%;
  margin-top: 24px;
}

.input-box label,
.input-login label,
.gender-box {
  color: #00ff7f;
}

.form :where(.input-box input, .input-login input) {
  position: relative;
  height: 35px;
  width: 100%;
  outline: none;
  font-size: 1rem;
  color: white;
  margin-top: 5px;
  border: 1px solid #00ff7f;
  border-radius: 6px;
  padding: 0 15px;
  background: #161616;
}

.input-box input:focus,
.input-login input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}

.form .column {
  display: flex;
  column-gap: 150px;
}

.form .gender-box {
  margin-top: 30px;
  margin-left: 155px;
}

.form :where(.gender-option, .gender) {
  display: flex;
  align-items: center;
  column-gap: 100px;
  flex-wrap: wrap;
  text-align: center;
}

.form .gender {
  column-gap: 5px;
}

.gender input {
  accent-color: #00ff7f;
}

.form :where(.gender input, .gender label) {
  cursor: pointer;
}

.gender label {
  color: #00ff7f;
}

.address :where(input) {
  margin-top: 10px;
}

.signup-link a {
  color: #00ff7f;
  font-size: 17px;
  text-decoration: underline;
}

.form button,
#submit-button {
  display: inline-block;
  width: 100%;
  color: #00ff7f;
  background-color: transparent;
  font-size: 1rem;
  font-weight: 400;
  margin-top: 15px;
  padding: 14px 13px 12px 13px;
  border: 1px solid #00ff7f;
  border-radius: 8px;
  line-height: 1;
  cursor: pointer;
  transition: all ease-in-out 0.3s;
}

.form button:hover,
#submit-button:hover {
  transition: all ease-in-out 0.3s;
  background-color: #00ff7f;
  color: #161616;
}

.buttons{
    display: flex;
    width: 100%;
    column-gap: 50px;
}
</style>
