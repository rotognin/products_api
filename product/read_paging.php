<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/core.php';
include_once '../shared.php';
include_once '../config/database.php';
include_once '../objects/product.php';

$utilities = new Utilities();

$database = new Database();
$db = $database->getConnection();

$products = new Product($db);

$stmt = $product->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

if ($num > 0){
    $products_arr = array();
    $products_arr['records'] = array();
    $products_arr['paging'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);

        $product_item = array(
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $category_id,
            'category_name' => $category_name
        );


    }

}


?>
