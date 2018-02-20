<?php

if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    require_once __DIR__.'/../vendor/autoload.php';
} elseif (file_exists(__DIR__.'/../../../../vendor/autoload.php')) {
    require_once __DIR__.'/../../../../vendor/autoload.php';
}

use RapidWeb\GoogleOAuth2Handler\GoogleOAuth2Handler;

echo PHP_EOL;
echo '*** PHP Google OAuth 2 Handler - Setup ***';
echo PHP_EOL.PHP_EOL;

echo 'Go to the following URL to setup a new or existing project.';
echo PHP_EOL;
echo 'When asked about credentials, you should setup OAuth credentials.';
echo PHP_EOL;
echo 'When done, enter the client ID and client secret below.';
echo PHP_EOL.PHP_EOL;

echo 'https://console.developers.google.com/start/api?id=people.googleapis.com&credential=client_key';
echo PHP_EOL.PHP_EOL;

$clientId = trim(readline('Google Client ID: '));
$clientSecret = trim(readline('Google Client Secret: '));
echo PHP_EOL;

$scopes = ['https://www.googleapis.com/auth/userinfo.profile', 'https://www.googleapis.com/auth/contacts', 'https://www.googleapis.com/auth/contacts.readonly'];

$googleOAuth2Handler = new GoogleOAuth2Handler($clientId, $clientSecret, $scopes);

echo 'Now, go to the following URL, sign in to your Google Account,';
echo PHP_EOL;
echo 'and copy-paste the auth code you receive below.';
echo PHP_EOL.PHP_EOL;

echo $googleOAuth2Handler->authUrl;
echo PHP_EOL.PHP_EOL;

$authCode = trim(readline('Auth Code: '));
echo PHP_EOL;PHP_EOL;

$refreshToken = $googleOAuth2Handler->getRefreshToken($authCode);

echo 'This account\'s refresh token is: '.$refreshToken;
echo PHP_EOL.PHP_EOL;

echo 'You should store this refresh token, as it is used to maintain';
echo PHP_EOL;
echo 'access to the Google account.';
echo PHP_EOL.PHP_EOL;

echo 'You can now create a GoogleOAuth2Handler object for this Google';
echo PHP_EOL;
echo 'account using the following code.';
echo PHP_EOL.PHP_EOL;

echo '$clientId     = \''.$clientId.'\';';
echo PHP_EOL;
echo '$clientSecret = \''.$clientSecret.'\';';
echo PHP_EOL;
echo '$refreshToken = \''.$refreshToken.'\';';
echo PHP_EOL;
echo '$scopes       = []; // Set required scopes. Available scopes: https://developers.google.com/identity/protocols/googlescopes';
echo PHP_EOL.PHP_EOL;
echo '$googleOAuth2Handler = new GoogleOAuth2Handler($clientId, $clientSecret, $scopes, $refreshToken);';
echo PHP_EOL.PHP_EOL;
