<?php
    session_start();
    include("connection.php");
    
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $query = "DELETE FROM `TB_ADMIN` WHERE ADMIN_ID = $id";
        $delete = mysqli_query($con, $query);
    }
    
    $query = "SELECT * FROM `tb_admin`";
    $query_run = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>administrator view</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
        include("adminNavbar.php");
    ?>

    <div class="table-name">
        <h2>ADMINISTRATORS TABLE</h2>
    </div>
    
    <div class="filter">
            <form  action="search-admin.php" method="POST">
                <select name="category">
                    <option value="ADMIN_ID" selected>Admin ID</option>
                    <option value="USERNAME">Username</option>
                    <option value="ADMIN_NAME">Name</option>
                    <option value="EMAIL_ADDRESS">E-Mail</option>
                    <option value="ROLE">Role</option>
                </select>
                <input type="text" name="search-value" placeholder="Value"></input>
                <input type="submit" name="search" value="Search" id="search-btn"></input>
            </form>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ADMIN ID</th>
                    <th>USERNAME</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th>OPERATIONS</th>

                </tr>
            </thead>

            <tbody>
                <?php
                    
                    if(mysqli_num_rows($query_run) > 0)
                    {
                         while($row = mysqli_fetch_assoc($query_run))
                         {
                            echo "                        
                            <tr>
                                <td>".$row['ADMIN_ID']."</td>
                                <td>".$row['USERNAME']."</td>
                                <td>".$row['ADMIN_NAME']."</td>
                                <td>".$row['EMAIL_ADDRESS']."</td>
                                <td>".$row['ROLE']."</td>
                                <td>
                                    <a href='adminPage.php?id=".$row['ADMIN_ID']."' class='btn'>Delete</a>
                                </td>
                            </tr>
                            ";
                        }
                    }
                                        

                ?>
            </tbody>
                                 
        </table>
    </div>
</body>
</html>


<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

<style>

*{
    text-decoration: none;
}


.btn{
    background-color: red;
    color: white;
    font-size: 1.2em;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 10px;
}

.btn:hover{
    background-color: #00ff7f;
}

.inline{
    margin-bottom: 10px;
}

body {
    background: #f5f5f5;
    margin-top: 10px;
    box-sizing: border-box;
    padding: 0;
}

.table-container{
    width: 80%;
    background-color: grey;
    margin-left: auto;
    margin-right: auto;
    height: 500px;
    overflow-y: scroll;
    border: 2px solid black;
}

.table{
    background-color: white;
    width: 100%;
    margin: 0 auto;
    font-family: Calibri;
    height: auto;
    border-collapse: collapse;
    overflow-y:auto;
}

table, th, td{
    border: 2px solid black;
    border-collapse: collapse;
}

td
{
    color: black;
    font-size: 1.1em;
}

.table thead tr{
    text-align: left;
    border: 2px solid black;
}

.table thead th{
    background-color: #027d40;
    color: white;
    position: sticky;
    top: 0;
}

.table th{
    text-align: center;
}

.table tbody tr{
    border-bottom: 1px solid white;
    text-align: center;
}

.table tbody tr:nth-of-type(even){
    background-color: #d1d1d1;
}

.filter{
    font-size: 18px;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 10px;
}

.table-name{
    margin-top: 90px;
    width: 80%;
    border-bottom: 3px solid grey;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 20px;

}

h2{
    font-size: 30px;
    font-weight: bold;
    text-align: center;
}

input, select{
    box-sizing: border-box;
    height: 30px;
    padding-left: 5px;   
}

#search-btn{
    background-color: #027d40;
    color: white;
    border: none;
    width: 100px;
    border-radius: 5px;
}

#search-btn:hover{
    background-color: #014d27;
}


</style>