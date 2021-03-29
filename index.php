<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

/*
http_response_code(200);
echo json_encode(array('retorno' => $_SERVER));
exit();
*/

/*
http_response_code(200);
echo json_encode(array('message' => 'Retorno de teste: ' . $get));
*/

$request_method = $_SERVER['REQUEST_METHOD'];

$routes = array(
    'GET' => array('products', 'categories'),
    'POST' => array()
);

if (!array_key_exists($request_method, $routes)){
    http_response_code(404);
    echo json_encode(array('message' => 'Método de busca não encontrado'));
    exit();
}

if ($request_method == 'GET'){
    $get = (isset($_GET['object'])) ? $_GET['object'] : '';

    if ($get == ''){
        http_response_code(404);
        echo json_encode(array('message' => 'Object de busca não passado.'));
        exit();
    }

    if (!in_array($get, $routes['GET'])){
        http_response_code(404);
        echo json_encode(array('message' => 'Rota não encontrada'));
        exit();
    }
}

if ($get == 'products'){
    include_once 'product/read.php';
} else {
    http_response_code(404);
    echo json_encode(array('message' => 'Rota não encontrada.'));
}

?>