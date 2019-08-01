<?php
// SITE_ROOT contains the full path to the tshirtshop folder
define('SITE_ROOT', dirname(dirname(__FILE__)));

//$con=mysqli_connect("example.com","peter","abc123","my_db");
define('DB_SERVERNAME','127.0.0.1');
define('DB_USERNAME','your_name');
define('DB_PASSWORD','your_password');
define('DB_DATABASE','my_db');
//define('PDO_DSN', 'mysql:host=' . DB_SERVER_MYSQL . ';dbname=' . DB_DATABASE_MYSQL);

// FTP connection
define('FTP_HOST', '127.0.0.1');//host
define('FTP_USERNAME', 'your_name');//host
define('FTP_PASSWORD', 'your_password');//host
define('FTP_PORT', '21');//port
define('FTP_TIMEOUT', '100');//timeout default 100

define('MAX_FILE_UPLOAD','400');
define('MAX_FILE_UPLOAD_IMAGE','1048576');
define('MAX_FILE_UPLOAD_VIDEO', '1048576');


?>
