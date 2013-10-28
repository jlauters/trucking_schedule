<?php
session_start();


/* load Google API Client */
require_once "Google_Client.php";
require_once "contrib/Google_CalendarService.php";

$apiClient = new Google_Client();
$apiClient->setUseObjects(true);
$service = new Google_CalendarService($apiClient);

if($apiConfig['oauth2_redirect_uri'] == $_SERVER['REQUEST_URI']) {
   echo "<pre>".var_dump($_REQUEST)."</pre>"; 
}

if(isset($_SESSION['oauth_access_token'])) {
    $apiClient->setAccessToken($_SESSION['oauth_access_token']);
} else {
    $token = $apiClient->authenticate();
    $_SESSION['oauth_access_token'] = $token;
}

echo <<<EOHTML
<html>
  <head>
    <title>Trucking Schedule Google Calendar Test</title>
  </head>

  <body>
    <h1>Trucking Schedule Google Calendar Test</h1>
  </body>

</html>
EOHTML;
