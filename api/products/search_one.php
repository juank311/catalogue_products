<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/connection_mysql.php';
include_once '../../models/products.php';

//Se instancia la base de datos 
$classConnection_mysql= new classConnection_mysql();
$db = $classConnection_mysql->connect();

//se instancia el primer objeto de la clase de metodos que se encuentran en categorias (search)
$products = new classProducts($db);
//Se obtiene el id que viene por url
$products->id = isset($_GET['id']) ? $_GET['id'] : die();

$result = $products->search_one();

$products_row = array
    (
        'id' => $products->id,
        'title' => $products->title,
        'text' => $products->text,
        'categorie_name' => $products->categorie_name,
        'creation_date' => $products->creation_date
    );
$categorieJson['data'] = ($products_row);
   
    //crear Json
    echo json_encode($categorieJson);