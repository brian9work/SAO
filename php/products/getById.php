<?php
include("../php/cn.php");
include("../php/cors.php");
include("../php/utils.php");
include("../php/search.php");

if(!isset($_GET['id_product'])) die(json_encode(["success" => false,"error" => "Error a recibir el id del producto"]));
$id = $_GET['id_product'];

$searchUser = "SELECT * FROM product WHERE id='$id'";
$resSearchUser=mysqli_query($con,$searchUser);
if($resSearchUser){
    if(mysqli_num_rows($resSearchUser)<1){
        die(json_encode(["success" => false,"data" => "El producto no existe"]));}}

$getProducts = "SELECT p.*,cc.category,cb.brand FROM product p
    INNER JOIN cat_brand cb ON p.id_brand=cb.id
    INNER JOIN cat_category cc ON p.id_category=cc.id
    WHERE p.id='$id'";
$resGetProducts=mysqli_query($con,$getProducts);
$json = array();
while ($row = mysqli_fetch_assoc($resGetProducts)) {
    $json[] = $row;
}
die(json_encode(["success" => true,"data" => $json]));


