<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

require 'twapp/autoload.php';
require 'twapp/tokens.php';
use Abraham\TwitterOAuth\TwitterOAuth;

// post ile gönderilen mesajı ve resmi alıyoruz.
$q = $_GET['q'];
$result_type = $_GET['result_type'];
$count = $_GET['count'];
$until = $_GET['until'];


//Session içindeki yetkimizi kullanmak için değişkene attık. 
$access_token = $_SESSION['access_token'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$connection->setTimeouts(10, 15);
// Temel kullanıcı bilgilerini getirme.
$user = $connection->get("account/verify_credentials");



$parameters = [
    'q' => $q,
    'lang' => 'tr',
    'count' => $count,
    'until' => $until,
    'result_type' => $result_type
];

$get = $connection->get('search/tweets', $parameters);
	
$tweets[] = $get;

$start = 1;
foreach ($get->statuses as $data) {
	echo $start. ":". $data->text. "<br>";
	$start++;
}

?>