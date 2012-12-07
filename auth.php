<?php
require('lib/PHP-OAuth2/Client.php');
require('lib/PHP-OAuth2/GrantType/IGrantType.php');
require('lib/PHP-OAuth2/GrantType/AuthorizationCode.php');

session_start();

$isLoggedIn = false;
$p2pmsg = "";

// These are your Singly client ID and secret from here:
// https://singly.com/apps
const CLIENT_ID = '';
const CLIENT_SECRET = '';

// Set his is the URL of this file (http://yourdomain.com/index.php, for example)
//const REDIRECT_URI = 'http://localhost:8888/bookapp/bookapp/login.php';
const REDIRECT_URI = '';

const AUTHORIZATION_ENDPOINT = 'https://api.singly.com/oauth/authenticate';
const TOKEN_ENDPOINT = 'https://api.singly.com/oauth/access_token';

$client = new OAuth2\Client(CLIENT_ID, CLIENT_SECRET);

function getSinglyAuthenticationUrl($service, $client) {
  $auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT, REDIRECT_URI)
    ."&service=". $service;

  if (isset($_SESSION['access_token'])) {
    $auth_url .= '&access_token=' . $_SESSION['access_token'];
  }
  return $auth_url;
}

if ($_GET['logout']) {
  unset($_SESSION['access_token']);
  header("Location: ./login.php"); 

} elseif (!isset($_GET['code'])) {

//header("Location: ./login.php");

} else {
   $params = array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI);

   $response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);

   $client->setAccessToken($response['result']['access_token']);
   // You should also store this in the user's session
   $_SESSION['access_token'] = $response['result']['access_token'];

   // From here on you can access Singly API URLs using $client->fetch
   $response = $client->fetch('https://api.singly.com/profiles');
   //print_r($response);
   //echo '<br>Go back to add another service.';

   loadUser($response);
}
?>