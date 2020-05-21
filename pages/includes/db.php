<?php
require_once("constants.php");
$connection= mysqli_connect(SERVER,USERNAME,PASSWORD,DB);
if(!$connection){
    die("SOme issue in connecting" . mysqli_error($connection));
}
?>