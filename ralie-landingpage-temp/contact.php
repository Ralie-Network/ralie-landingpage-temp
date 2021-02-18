<?php

define('DB_NAME', 'raliea_db1');
define('DB_USER', 'raliea_1');
define('DB_PASSWORD', 'Pd16u5sNy8qyALve');
define('DB_HOST', 'sql329.your-server.de');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

if(!$connection){
die('Database connection failed: ' . mysqli_connect_error());
}

$db_selected = mysqli_select_db($connection, DB_NAME);

if(!$db_selected){
die('Can\'t use ' .DB_NAME . ' : ' . mysqli_connect_error());
}

if($_POST['email']){
    $email = $_POST['email'];
}else{
    echo 'email not received';
    exit;
}

$uniqueId= time().'-'.mt_rand();


$sql = "INSERT INTO contact_form (id, email) 
        VALUES ('$uniqueId','$email')";

if (!mysqli_query($connection, $sql)){
die('Error: ' . mysqli_connect_error($connection));
}

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;

?>