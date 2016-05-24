<?php
use \Firebase\JWT\JWT;

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'demo',
    'clientSecret'            => '0b2cbd34-a05e-4104-b7ec-350ee81bb7eb',
    'redirectUri'             => 'http://localhost/accounts-demo-php/index.php?page=login',
    'urlAuthorize'            => 'https://accounts.organicity.eu/realms/organicity/protocol/openid-connect/auth',
    'urlAccessToken'          => 'https://accounts.organicity.eu/realms/organicity/protocol/openid-connect/token',
    'urlResourceOwnerDetails' => 'https://accounts.organicity.eu/realms/organicity/protocol/openid-connect/userinfo'
]);

function handleToken($accessToken) {
  global $provider;
  $key = file_get_contents("key.pub");

  $decoded = (array) JWT::decode($accessToken->getToken(), $key, array('RS256'));
  // Roles are only delivered with the token!
  $_SESSION['roles'] = (isset($decoded['resource_access']->demo)) ? $decoded['resource_access']->demo->roles : [];
  // Save the token
  $_SESSION['token'] = json_encode($accessToken->jsonSerialize());
}

// This refreshes the token
if(isset($_SESSION['token'])) {
  $t = (array) json_decode($_SESSION['token']);
  $accessToken = new \League\OAuth2\Client\Token\AccessToken($t);

  if($accessToken->hasExpired()) {
    $newAccessToken = $provider->getAccessToken('refresh_token', [
      'refresh_token' => $accessToken->getRefreshToken()
    ]);
    echo "<script>console.log('New token generated!');</script>";
    handleToken($newAccessToken);
  } else {
    $diff = $accessToken->getExpires() - time();
    echo "<script>console.log('Token expires in: " . $diff . "s');</script>";
  }
}


?>