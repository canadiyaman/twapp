<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require 'twapp/autoload.php';
require 'twapp/tokens.php';
use Abraham\TwitterOAuth\TwitterOAuth;

$user = $_GET['user'];
$count = $_GET['count'];
//Session içindeki yetkimizi kullanmak için değişkene attık. 
$access_token = $_SESSION['access_token'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

//$connection->setTimeouts(10, 15);
// Temel kullanıcı bilgilerini getirme.
$user = $connection->get("account/verify_credentials");

$parameters = [
    'count' => $count,
    'screen_name' => $user,
    'exclude_replies' => true
];

$get = $connection->get('statuses/user_timeline', $parameters);

$tweets[] = $get;

$start = 1;

foreach ($tweets as $page) {
	foreach ($page as $key) {
		echo $start . ':' . $key->text . '<br>';
		$start++;
	}
}

?>