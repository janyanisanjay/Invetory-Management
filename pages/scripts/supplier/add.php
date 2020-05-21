<?php
//echo "hello";
session_start();
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
$employee_id = $_SESSION['employee_id'];

if(isset($_POST['add_supplier'])){
    
    $supplier_name = $_POST['supplier_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_email = $_POST['supplier_email'];
    $supplier_contact = $_POST['supplier_contact'];
    $gst_no = $_POST['gst_no'];
    $query="Select * from supplier where supplier_contact = $supplier_contact";
    $result=mysqli_query($connection,$query);
    
    if(mysqli_num_rows($result) == 0){
    $columns='supplier_name,supplier_address,supplier_email,supplier_contact,gst_no,created_at,created_by';
    $values="'$supplier_name','$supplier_address','$supplier_email','$supplier_contact','$gst_no',now(),$employee_id";
    $result_set=insert('supplier',$columns,$values);
    $_SESSION['statuss'] = SUPPLIER_ADD_SUCCESS;
    //echo $_SESSION['statuss'];
    redirect("http://".BASE_SERVER."/erp/pages/add-supplier.php?q=success");  
    }
    else{
        header("Location: http://".BASE_SERVER."/erp/pages/add-supplier.php?q=error");
        exit;
    }
}
?>