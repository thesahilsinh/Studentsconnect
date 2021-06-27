<?php
session_start();

if ($_SESSION["username"] == "") {
    header("location:login_page.html");
    exit;
}
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Dashboard</title>
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
    <h1 class="text-center">Dashboard</h1>
	<br>
	<a href="event_form.html">
  		<button type="button" class="btn btn-info">
          <span class="create event"></span>Create Event
        </button>
	</a>
  <a href="profile.php?profileusername=<?php echo $username;?>">
  		<button type="button" class="btn btn-info">
          <span class="view_profile"></span>View My Profile
        </button>
	</a>
  <a href="profiles.php">
        <button type="button" class="btn btn-info"> 
        <span class="view_profile"></span>View All Mentor Profiles
        </button>
	</a>
	<a href="logout.php">
          <button type="button" class="btn btn-default">
          <span class="glyphicon glyphicon-log-out"></span> Log out
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

    $sql = "SELECT * FROM myevents WHERE datetime >= CURRENT_TIMESTAMP ORDER BY datetime";   
    $result = $conn->query($sql);
    if($result->rowCount() > 0){
        echo "<table class='table_style p-3 m-3'>";
            echo "<tr>";
                echo "<th>Name of Mentor</th>";
                echo "<th>Date and Time</th>";
                echo "<th>Topic</th>";
                echo "<th>Description</th>";
				echo "<th>Link</th>";
            echo "</tr>";
        while($row = $result->fetch()){
            echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['datetime'] . "</td>";
                echo "<td>" . $row['topic'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
				echo "<td><a target='_blank' href=". $row['eventlink'] ." class='btn btn-info' role='button'>Link</a></td>";
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