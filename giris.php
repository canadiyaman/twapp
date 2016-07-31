<?php 
session_start();
require 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT id,username, password, access_token FROM users WHERE username='".$username."' and password='".$password."' ";

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$active = $row['active'];
      
$count = mysqli_num_rows($result);


if ($count == 1)
{
	$_SESSION["username"] = $row["username"];
	$_SESSION['user_id'] = $row['id'];
	
	$_SESSION['access_token'] = json_decode($row['access_token'], true);
	header('Location: ./');
}
else
{
	echo $username." adında biri yok.";
}

$conn->close();
?>