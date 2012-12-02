<?php session_start(); if (isset($_SESSION['access_token'])) { header("Location: ./index.php"); } ?>
<?php include("./elements/header.php"); ?>

<h2>Login to p2papps</h2>

<?php if (isset($_SESSION['access_token'])) { ?>
<p>You are logged in.</p>
<p><a class="btn" href="?logout=true">Log Out</a></p>

<?php } else { ?>

<p>You can login with Facebook. Aaand that's pretty much it. <em>Because we're dicks.</em>

<?php 

$services = Array('facebook');

foreach ($services as $service) {
  echo '<p><a class="btn" href="' . getSinglyAuthenticationUrl($service, $client) . '">Connect with ' . $service . "</a></p>";
}

}

include("./elements/footer.php"); ?>