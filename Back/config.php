<?php
// define('DB_SERVER', 'sql313.infinityfree.com');
// define('DB_USERNAME', 'if0_38449771');
// define('DB_PASSWORD', 'MRt5NNkCKTO');
// define('DB_NAME', 'if0_38449771_foundify');

define('DB_SERVER', '89.213.177.80');
define('DB_USERNAME', 'toon');
define('DB_PASSWORD', 'toon1234');
define('DB_NAME', 'lostnfound');
// define('')


$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn === false){
    die("ERROR: Could not connect. " . $conn->connect_error);
}
?>