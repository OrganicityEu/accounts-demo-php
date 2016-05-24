<?php

if(!isset($_SESSION['token'])) {
	echo '<div class="alert alert-danger"><b>401 Unauthorized</b> You\'re not logged in!</div>';
} else {

  // Decode the token from JSON to an AccessToken object
  $token = (array) json_decode($_SESSION['token']);
  $accessToken = new \League\OAuth2\Client\Token\AccessToken($token);

  // We can use the userinfo/ResourceOwner endpoint to get the profile data for the user
  $resourceOwner = $provider->getResourceOwner($accessToken);
  $user = $resourceOwner->toArray();

	echo '<h3>Profile</h3>';
	echo '<ul>';
	echo '  <li>Username: ' . $user['preferred_username'] . '</li>';
	echo '  <li>Email: ' . $user['email'] . '</li>';
	echo '  <li>Roles: ' . implode(", ", $_SESSION['roles']) . '</li>';
	echo '</ul>';
}

?>

