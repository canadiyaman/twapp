<?php
session_start();
require 'twapp/autoload.php';
require 'twapp/tokens.php';
use Abraham\TwitterOAuth\TwitterOAuth;

// post ile gönderilen mesajı ve resmi alıyoruz.
$message = $_POST['message'];
$image = $_FILES['image']['tmp_name'];

//Session içindeki yetkimizi kullanmak için değişkene attık. 
$access_token = $_SESSION['access_token'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$connection->setTimeouts(10, 15);
// Temel kullanıcı bilgilerini getirme.
$user = $connection->get("account/verify_credentials");

$tweetWM = $connection->upload('media/upload', ['media' => $image ]);

$parameters = [
    'status' => $message,
    'media_ids' => implode(',', [$tweetWM->media_id_string])
];

$post = $connection->post('statuses/update', $parameters);
	
echo "<pre>";
print_r($post);
echo "</pre>";

?>