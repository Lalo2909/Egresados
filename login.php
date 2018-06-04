<?php
session_start();
?>

<?php

include 'conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM login WHERE user = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
}
$row = $result->fetch_assoc();

if ( $row["password"] == $password) {
  $_SESSION['loggedin'] = true;
  $_SESSION['username'] = $username;
  $_SESSION['start'] = time();
  $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

  header ("Location: profile.php");

} else {
  header ("Location: errorMessage.html");
}
$conn->close();
?>
