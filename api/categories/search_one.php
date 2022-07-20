<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/connection_mysql.php';
include_once '../../models/categories.php';

//Se instancia la base de datos 
$classConnection_mysql= new classConnection_mysql();
$db = $classConnection_mysql->connect();

//se instancia el primer objeto de la clase de metodos que se encuentran en categorias (search)
$classCategories = new classCategories($db);
//Se obtiene el id que viene por url
$classCategories->id = isset($_GET['id']) ? $_GET['id'] : die();

$result = $classCategories->search_one();

$categorie_row = array
    (
        'id' => $classCategories->id,
        'nombre' => $classCategories->name,
        'creation_date' => $classCategories->creation_date
    );
$categorieJson['data'] = array($categorie_row);
   
    //crear Json
    echo json_encode($categorieJson);