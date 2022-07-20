<?php
//Encabezados (Header de una api
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: POST');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//incluir conexion a la base de datos 
include_once '../../config/connection_mysql.php';
include_once '../../models/categories.php';


//Instancionamos la base de datos y conexión
$baseDatos = new classConnection_mysql();
$db = $baseDatos->connect();

//Instanciamos el objeto categoría
$categories = new classCategories($db);

$data = json_decode(file_get_contents("php://input"));

$categories->name = $data->name;

//Crear categorías
if($categories->insert()){
    echo json_encode(
        array('message' => 'Categoría creada')
    );
}else{
    echo json_encode(
        array('message' => 'Categoría no creada')
    );
}

