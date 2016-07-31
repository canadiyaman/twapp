<?php
session_start();
require 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "insert into users(username , password ) values ('".$username."','".$password."')";

if ($conn->query($sql) === TRUE) {
	header("Location: ./");
    echo "Yeni Kayıt başarılı";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>