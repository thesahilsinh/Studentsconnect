<?php

session_start();

$username = $_SESSION['username'];
$topic = $_POST['topic'];
$description = $_POST['dis'];
$datetime = $_POST['datetime'];
$eventlink = "https://meet.jit.si/student-connect-platform-".random_int(1 , 99999999);


$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";


try {
  $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt1 = $conn->prepare("SELECT * FROM myevents where topic=:topic and username=:username");
  $stmt1->bindParam(':topic', $topic);
  $stmt1->bindParam(':username', $username);

  $stmt1->execute();
  $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

  if($result1 == "") {
    
    $stmt = $conn->prepare("INSERT INTO myevents (username, topic, description, datetime, eventlink) VALUES (:username, :topic, :description, :datetime, :eventlink)");

  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':topic', $topic);
  $stmt->bindParam(':description', $description);
  $stmt->bindParam(':datetime', $datetime);
  $stmt->bindParam(':eventlink', $eventlink);

  // use exec() because no results are returned
  $stmt->execute();
  echo "New event created successfully. Please wait while you will be redirected to the dashboard !!!";
  sleep(3);
  header("location:dashboard.php");
  
  } else {
    echo "Event already Exists...";
  } 
} catch(PDOException $e) {
  echo $stmt1. "<br>" . $e->getMessage();
}

try {
  $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

} catch(PDOException $e) {
  echo $stmt . "<br>" . $e->getMessage();
}

$conn = null;


?>