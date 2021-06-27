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
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt1 = $conn->prepare("SELECT * FROM myaccounts where email=:email");
  $stmt1->bindParam(':email', $email);

  $stmt1->execute();
  $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

  if($result1 == "") {
    
    $stmt = $conn->prepare("INSERT INTO myaccounts (username, email, password, qualification) VALUES (:name, :email, :password, :qualification)");
    
    $stmt->bindParam(':name', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':qualification', $qualification);

    $stmt->execute();
    echo "New record created successfully";
  
  } else {
    echo "User Already Exists...";
  } 
} catch(PDOException $e) {
  echo $stmt1. "<br>" . $e->getMessage();
}

$conn = null;

?>