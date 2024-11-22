<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
</head>
<body>
<?php
        include("adminNavbar.php");
    ?>
<h1>SEARCH RESULTS</h1>
<div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>RESERVATION ID</th>
                    <th>SEAT ID</th>
                    <th>BUYER ID</th>
                    <th>USERNAME</th>
                    <th>RESERVATION DATE</th>
                    <th>PRICE</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    include("Connection.php");
                    if(isset($_POST['category']))
                    {
                        $category = $_POST['category'];

                        $query = "SELECT * FROM tb_reservations WHERE SEAT_ID LIKE '%$category%' ORDER BY RESERVATION_DATE DESC";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                                echo "                        
                                <tr>
                                    <td>".$row['RESERVATION_ID']."</td>
                                    <td>".$row['SEAT_ID']."</td>
                                    <td>".$row['BUYER_ID']."</td>
                                    <td>".$row['BUYER_NAME']."</td>
                                    <td>".$row['RESERVATION_DATE']."</td>
                                    <td>".$row['PRICE']."</td>
                                </tr>
                                ";
                            }
                        }

                        else
                        {
                            echo "
                                <tr>
                                    <td>No Records Found<td>
                                </tr>
                            ";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="back">
        <form method = "POST"action="reservationsPage.php"><button id = "back" type="submit">Back</button></form>
    </div>
</body>
</html>

<style>
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

h1{
        text-align: center;
        font-family: calibri;
        font-weight: bold;
        margin-top: 80px;
    }

    .back{
        width: 80%;
        margin: 0 auto;
        padding-top: 10px;
    }

    #back{
    cursor: pointer;
    font-size: 18px;
    background-color: #027d40;
    color: white;
    border: none;
    width: 100px;
    border-radius: 5px;
    padding: 10px 10px;
}

#back:hover{
    background-color: #014d27;
}
</style>