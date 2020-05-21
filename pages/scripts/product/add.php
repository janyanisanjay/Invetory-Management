<?php
session_start();
require_once("../../includes/functions.php");
$employee_id = $_SESSION['employee_id'];


//////////////////////////////////////////////****Code for Uploading a image to server************ 
//$image_name = $_FILES['product_image']['name'];
//$image_size = $_FILES['product_image']['size'];
//$temp_name = $_FILES['product_image']['tmp_name'];
//$file_type = $_FILES['product_image']['type'];
//
//$file_extension =strtolower(end(explode(".",$image_name)));
//echo "Image name : ".$image_name;
//echo "<br> Image size : $image_size";
//echo "<br> Temp Name : $temp_name";
//echo "<br> File tyep : $file_type";
//echo "<br> File Extension : $file_extension";
//
//$valid_extension = array("jpeg","jpg","png");
//
//if(in_array($file_extesion,$valid_extension) == false){
//    $error_msg[] = "Image is not valid! please select Jpeg or jpg file";
//}
//if($image_size>2097152){
//    $error_msg[] = "image size too large! please selet within 2kb";
//}
//if(empty($error_msg)){
//    move_uploaded_file($temp_name,"../../../assets/products/images/".$image_name);
//    echo "suuccfully uploaded";

//}
//else{
//    print_r($error_msg);
//}



///////////////******************End of code to upload image ***************************


//
//
//
//
//
//echo "hello";
//
if(isset($_POST['add_product'])){
    //check wheter the file was uploaded or not
    if(isset($_FILES['product_image'])){
        $image_name = $_FILES['product_image']['name'];
        $image_size = $_FILES['product_image']['size'];
        $temp_name = $_FILES['product_image']['tmp_name'];
        $file_type = $_FILES['product_image']['type'];

        $file_extension =strtolower(end(explode(".",$image_name)));        
    }
    $product_name = $_POST['product_name'];
    $rate_of_sale = $_POST['rate_of_sale'];
    $category_id = $_POST['category_id'];
    $eoq = $_POST['eoq'];
    $additional_specification = $_POST['additional_specification'];
    $suppliers = $_POST['supplier_id'];

    
    
    $tablename = "product";
    $columns = "product_name , eoq,additional_specification , category_id,image_extension,created_by";
    $values = "'$product_name', $eoq,'$additional_specification' , '$category_id','$file_extension', $employee_id";
    
    $result = insert($tablename,$columns,$values);
    $product_id = mysqli_insert_id($connection);
    
    $tablename = "product_sale_rate";
    $columns = "product_id,rate_of_sale,wef,created_by";
    $values = "$product_id,$rate_of_sale,now(), $employee_id";
    $result = insert($tablename,$columns,$values);
    
    $tablename = "product_supplier";
    $columns = "product_id,supplier_id";
    foreach($suppliers as $supplier_id){
        
        $values = "$product_id,$supplier_id";
        $result = insert($tablename,$columns,$values);
        
    }
    if(isset($_FILES['product_image'])){
        move_uploaded_file($temp_name,"../../../assets/products/images/".$product_id.".".$file_extension);
    }
    
    echo "Added";
    $_SESSION['status'] = CUSTOMER_ADD_SUCCESS;
    
    
    
}
?>











<!--$query=select product.product_name,product.eoq,product.additional_specification,supplier.supplier_name,category.category_name-->












