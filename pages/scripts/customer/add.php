<?php
//echo "hello";
session_start();
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
$employee_id = $_SESSION['employee_id'];

if(isset($_POST['add_customer'])){
    
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $customer_email = $_POST['customer_email'];
    $customer_contact = $_POST['customer_contact'];
    $gst_no = $_POST['gst_no'];
    $query="Select * from customer where customer_contact = $customer_contact";
    $result=mysqli_query($connection,$query);
    
    if(mysqli_num_rows($result) == 0){
    $columns='customer_name,customer_address,customer_email,customer_contact,gst_no,created_at,created_by';
    $values="'$customer_name','$customer_address','$customer_email','$customer_contact','$gst_no',now(),$employee_id";
    $result_set=insert('customer',$columns,$values);
    $_SESSION['statuss'] = CUSTOMER_ADD_SUCCESS;
    //echo $_SESSION['statuss'];
    redirect("http://".BASE_SERVER."/erp/pages/add-customer.php?q=success");  
    }
    else{
        header("Location: http://".BASE_SERVER."/erp/pages/add-customer.php?q=error");
        exit;
    }
}
?>