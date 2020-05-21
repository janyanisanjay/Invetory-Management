<?php
require_once("../../includes/functions.php");
require_once("../../includes/db.php");

session_start();

echo "hello";

if(isset($_POST['edit_product'])){
    echo "in if";
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    
    $employee_id = $_SESSION['employee_id'];
    
    $query = "UPDATE category SET category_name = 'product_name',updated_by = $employee_id, updated_at = now() WHERE category_id = $category_id";
    
    $result = mysqli_query($connection,$query);
    checkQueryResult($result);
    
    echo "updated";
    
    
    //$_SESSION['status'] = CATEGORY_EDIT_SUCCESS;
    header("Location: http://".BASE_SERVER."/erp/pages/manage-category.php");
    exit();
}
    
?>