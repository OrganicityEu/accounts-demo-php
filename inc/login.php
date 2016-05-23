<?php

use \Firebase\JWT\JWT;

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'demo',
    'clientSecret'            => null,
    'redirectUri'             => 'http://localhost/accounts-demo-php/index.php?page=login',
    'urlAuthorize'            => 'https://accounts.organicity.eu/realms/organicity/protocol/openid-connect/auth',
    'urlAccessToken'          => 'https://accounts.organicity.eu/realms/organicity/protocol/openid-connect/token',
    'urlResourceOwnerDetails' => null
]);

// If we don't have an authorization code then get one
if (!isset($_GET['code'])) {

    // Fetch the authorization URL from the provider; this returns the
    // urlAuthorize option and generates and applies any necessary parameters
    // (e.g. state).
    $authorizationUrl = $provider->getAuthorizationUrl();

    // Get the state generated for you and store it to the session.
    $_SESSION['oauth2state'] = $provider->getState();

    // Redirect the user to the authorization URL.
    header('Location: ' . $authorizationUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {

    try {
        // Try to get an access token using the authorization code grant.
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        $privKey = openssl_pkey_new(array('digest_alg' => 'sha256',
            'private_key_bits' => 1024,
            'private_key_type' => OPENSSL_KEYTYPE_RSA));
        $msg = JWT::encode('abc', $privKey, 'RS256');
        $pubKey = openssl_pkey_get_details($privKey);
        $pubKey = $pubKey['key'];

        echo "<pre>";
        echo $pubKey;
        echo "</pre>";
        echo "<br>";

        $key = file_get_contents("key.pub");

        $decoded = (array) JWT::decode($accessToken->getToken(), $key, array('RS256'));
        $_SESSION['username'] = $decoded['name'];
        $_SESSION['email'] = $decoded['email'];
        $_SESSION['roles'] = (isset($decoded['resource_access']->demo)) ? $decoded['resource_access']->demo->roles : [];

        header('location: /accounts-demo-php/index.php?page=profile');
        exit();
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

        echo "ERROR";
        // Failed to get the access token or user details.
        exit($e->getMessage());

    }

}

?>
