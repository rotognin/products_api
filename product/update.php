<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once 'config/database.php';
include_once 'objects/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents('php://input'));

$product->id = $data->id;

// A ser feito: Antes de atualizar, o ideal é ver se o produto existe.
// Podemos chamar o método readOne() para ver se ele existe na base,
// ou criar um método que apenas recebe o ID e verifica se o produto existe.

$product->name        = $data->name;
$product->price       = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;

if ($product->update()){
    http_response_code(200); // OK
    echo json_encode(array('message' => 'Produto atualizado.'));
} else {
    http_response_code(503);
    echo json_encode(array('message' => 'Não foi possível atualizar o Produto.'));
}

?>