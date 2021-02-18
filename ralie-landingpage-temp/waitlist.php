<?php

define('DB_NAME', 'raliea_db1');
define('DB_USER', 'raliea_1');
define('DB_PASSWORD', 'Pd16u5sNy8qyALve');
define('DB_HOST', 'sql329.your-server.de');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

if(!$connection){
die('Database connection failed: ' . mysqli_connect_error());
}

$from = "contact@ralie.io";
$subject = "Your are on the waitlist for Ralie Network 1st Airdrop!";
$message = "You have successfully registered for Ralie Network 1st Airdrop. The distribution is scheduled for March 17th.";
$headers = "From:" . $from;
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

if($_POST['wallet']){
    $wallet = $_POST['wallet'];
}else{
    echo 'wallet not inserted';
    exit;
}

mail($email,$subject,$message,$headers);

$uniqueId= time().'-'.mt_rand();


$sql = "INSERT INTO airdrop_form (id, email, wallet) 
        VALUES ('$uniqueId','$email','$wallet')";

if (!mysqli_query($connection, $sql)){
die('Error: ' . mysqli_connect_error($connection));
}

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;

?>