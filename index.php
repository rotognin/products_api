<?php

/**
 * Ponto de entrada da API.
 * Por GET deverá ser passado 2 parâmetros:
 * 'object' = Refere-se ao objeto que pretende-se interagir
 * 'action' = Qual a ação que se pretende executar
 * 
 * O método a ser utilizado será pego pela requisição enviada ao servidor
 * $_SERVER['REQUEST_METHOD']
 */

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

$method_arr = array('GET', 'POST');
$object_arr = array('product', 'category');
$action_arr = array('create', 'read', 'update', 'delete');

$request_method = $_SERVER['REQUEST_METHOD'];

if (!in_array($request_method, $method_arr)){
    http_response_code(404);
    echo json_encode(array('message' => 'Incorrect method passed to the server'));
    exit();
}

$object = (isset($_GET['object'])) ? $_GET['object'] : '';

if (!in_array($object, $object_arr)){
    http_response_code(404);
    echo json_encode(array('message' => 'Incorrect object passed to the server'));
    exit();
}

$action = (isset($_GET['action'])) ? $_GET['action'] : '';

if (!in_array($action, $action_arr)){
    http_response_code(404);
    echo json_encode(array('message' => 'Incorrect action passed to the server'));
    exit();
}

$id = (isset($_GET['id'])) ? (int) $_GET['id'] : (int) 0;

include_once 'controller/' . $object . '.php';

?>