<?php
session_start();

$username = $_POST['username'];
$password = $_POST['pswd'];

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";

try {
  $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM myaccounts WHERE username=:username and password=:password");

  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);

  $stmt->execute();

  if($stmt->rowCount() > 0) {
        //echo "Correct Credentials !!!";
        $_SESSION['username'] = $username;
        header("location: dashboard.php");
    } else {
        echo "Wrong Credentials !!!<br>";
        echo "Please <a href='login_page.html'>go back and try again</a> !!!";
    }

} catch(PDOException $e) {
  echo $stmt . "<br>" . $e->getMessage();
}

$conn = null;

?>