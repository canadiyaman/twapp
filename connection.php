<?php
// Bağlantı ayarları.
define('host', '95.173.172.70');
define('username', 'canadiya');
define('password','e0S12uv3Ch');
define('database', 'canadiya_man');

$conn = mysqli_connect(host,username, password,database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


?>