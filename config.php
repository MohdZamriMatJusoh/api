<?php
// SITE_ROOT contains the full path to the tshirtshop folder
define('SITE_ROOT', dirname(dirname(__FILE__)));

//$con=mysqli_connect("example.com","peter","abc123","my_db");
define('DB_SERVERNAME','127.0.0.1');
define('DB_USERNAME','root');
define('DB_PASSWORD','skpres');
define('DB_DATABASE','ewi_roaming_db');
//define('PDO_DSN', 'mysql:host=' . DB_SERVER_MYSQL . ';dbname=' . DB_DATABASE_MYSQL);

// FTP connection
define('FTP_HOST', '127.0.0.1');//host
define('FTP_USERNAME', 'root');//host
define('FTP_PASSWORD', 'P@$$w0rd');//host
define('FTP_PORT', '21');//port
define('FTP_TIMEOUT', '100');//timeout default 100

define('MAX_FILE_UPLOAD','400');
define('MAX_FILE_UPLOAD_IMAGE','1048576');
define('MAX_FILE_UPLOAD_VIDEO', '1048576');

//Push Notification
// API access key from Google API's Console
define('ONESIGNAL_REST_API_URL','https://onesignal.com/api/v1/notifications');
define('ONESIGNAL_REST_API_KEY','MzA5ODRjZWYtYTg0Ny00OTA0LWE1OGQtYzg1MTM4Yzc4MTRk');
define('APP_ID','09041cc5-1a31-4e7f-b087-c8426a140a46');
?>
