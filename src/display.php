<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Records</title>
    <style>
        table{
            width: 70%;
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
        }
        table, tr, th, td{
            border: 1px solid #d4d4d4;
            border-collapse: collapse;
            padding: 12px;
        }
        th, td{
            text-align: left;
            vertical-align: top;
        }
        tr:nth-child(even){
            background-color: #e7e9eb;
        }
    </style>
<body>
      
<?php
    //Connect to DB
    $mysqli = require __DIR__ . "/database.php";

    //creating connection to database
    $mysqli = mysqli_connect($host, $username, $password, $dbname);

    //checking if connection is working or not
    if(!$mysqli)
    {
        die("Connection failed!" . mysqli_connect_error());
    }
    else 
    {
        echo "Successfully Connected! <br>";
    }
    
    //Output Form Entries from the Database
    $sql = "SELECT id, name, email, password_hash FROM users";
    //fire query
    $result = mysqli_query($mysqli, $sql);
    if(mysqli_num_rows($result) > 0)
    {
       echo '<table> <tr> <th> Id </th> <th> Name </th> <th> Email </th> <th> Message </th> </tr>';
       while($row = mysqli_fetch_assoc($result)){
         // to output mysql data in HTML table format
           echo '<tr > <td>' . $row["id"] . '</td>
           <td>' . $row["name"] . '</td>
           <td> ' . $row["email"] . '</td>
           <td>' . $row["password_hash"] . '</td> </tr>';
       }
       echo '</table>';
    }
    else
    {
        echo "0 results";
    }
    // closing connection
    mysqli_close($mysqli);

?>
</body>
</html>