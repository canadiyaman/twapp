<?php
session_start();
require 'twapp/autoload.php';
require 'twapp/tokens.php';
use Abraham\TwitterOAuth\TwitterOAuth;

// get ile gönderilen mesajı alıyoruz.
$message = $_GET['message'];

//Session içindeki yetkimizi kullanmak için değişkene attık. 
$access_token = $_SESSION['access_token'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	
// Temel kullanıcı bilgilerini getirme.
$user = $connection->get("account/verify_credentials");

$post = $connection->post('statuses/update', ['status' => $message]);

echo "<pre>";
print_r($post);
echo "</pre>";

?>