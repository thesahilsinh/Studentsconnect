<?php
session_start();

$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pswd'];
$qualification = $_POST['quali'];

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";

try {
  $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

try {
  $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("INSERT INTO myaccounts (username, email, password, qualification) VALUES (:name, :email, :password, :qualification)");
  //$stmt = prepare($sql);

  $stmt->bindParam(':name', $username);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':qualification', $qualification);

  // use exec() because no results are returned
  $stmt->execute();
  echo "New record created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

?>