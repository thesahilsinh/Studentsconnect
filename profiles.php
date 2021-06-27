<?php
session_start();

if ($_SESSION["username"] == "") {
    header("location:index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Profile Page</title>
    <style>
        .table_style {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        .table_style td, .table_style th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        .table_style tr:hover {background-color: #ddd;}

        .table_style th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        }
  </style>
</head>
<body>
  <div class="container">
    <div class="profile">
      <h1 class="text-center">Profiles Page</h1>
    </div>
    <br>
    <a href="dashboard.php">
		<button type="button" class="btn btn-info">
			<span class="create event"></span>Go to Dashboard
		</button>
	</a>
	<br>
	<br>
    
    <?php

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";

try {
	$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM myaccounts";   
    $result = $conn->query($sql);
    if($result->rowCount() > 0){
        echo "<table class='table_style p-3 m-3'>";
            echo "<tr>";
                echo "<th>Name of Mentor</th>";
                echo "<th>View Profile</th>";
            echo "</tr>";
        while($row = $result->fetch()){
            echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
				echo "<td><a href=profile.php?profileusername=". $row['username'] ." class='btn btn-info' role='button'>Profile</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        unset($result);
    } else{
        echo "No records matching your query were found.";
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close connection
unset($pdo);
?>

  </div>
</body>
</html>