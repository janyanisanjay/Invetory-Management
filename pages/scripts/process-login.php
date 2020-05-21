<?php
require_once("../includes/db.php");
require_once("../includes/functions.php");
session_start();
if(isset($_POST['submit']))
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM employee WHERE employee_email = '$username'";
    $select_user_details = mysqli_query($connection, $query);

    checkQueryResult($select_user_details);
    //procced if the data is returned otherwise there would be error
    if(mysqli_num_rows($select_user_details)>1){
        die("HOW?");
        //later we would crete error wala page and will print error in user friendly way
        //header()
    }
//if i coming here that means i have exactly 0/1 row
// $bd_password = "";
if($row = mysqli_fetch_assoc($select_user_details)){
    //I have 1 row
    
    $db_password = $row['employee_password'];
    $employee_id = $row['employee_id'];
}else{
    $db_password="";
}

//echo "<br>before psrwd check";
if(password_verify($password, $db_password)){
    //echo '<br>in if';
    $_SESSION['employee_id'] = $employee_id;
    header("Location: ../index.php");
}
else{
    die(" Some prblm");
    //header();
}

?>