<?php 
$db_params = array(
    '127.0.0.1',
    'stlearn',
    '123456',
    'faqs'
);
$con = mysqli_connect($db_params[0], $db_params[1], $db_params[2], $db_params[3]);
if(mysqli_connect_errno()) die('error in connecting to database:'. mysqli_error($con));
mysqli_set_charset($con, 'utf8');


?>
