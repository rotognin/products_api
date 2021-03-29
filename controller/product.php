<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

switch ($action)
{
    case 'read':
        if ($id == 0){
            // Irá retornar todos os produtos
            include_once 'product/read.php';
        } else {
            include_once 'product/read_one.php';
        }
        break;

    case 'create':
        include_once 'product/create.php';
        break;

    case 'update':
        include_once 'product/update.php';
        break;

    case 'delete':
        include_once 'product/delete.php';
        break;
}

?>