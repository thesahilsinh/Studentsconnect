<?php

session_start();

$username = $_SESSION['username'];
$eventid = $_GET['eventid'];


$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";


try {
  $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("DELETE FROM myevents WHERE eventid=:eventid");

  $stmt->bindParam(':eventid', $eventid);

  // use exec() because no results are returned
  $stmt->execute();
  echo "Your Event is Deleted Successfully. Please wait while you will be redirected to the dashboard !!!";
  sleep(3);
  header("location:dashboard.php");

} catch(PDOException $e) {
  echo $stmt . "<br>" . $e->getMessage();
}

$conn = null;


?>