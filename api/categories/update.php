<?php
//Encabezados (Header de una api
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: PUT');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//incluir conexion a la base de datos 
include_once '../../config/connection_mysql.php';
include_once '../../models/categories.php';


//Instancionamos la base de datos y conexión
$baseDatos = new classConnection_mysql();
$db = $baseDatos->connect();

//Instanciamos el objeto categoría
$categories = new classCategories($db);

// SE obtienen los datos por ingresar a la api
$categories->id = isset($_GET['id']) ? $_GET['id'] : die();

$data = json_decode(file_get_contents("php://input"));
$categories->name = $data->name;

//Crear categorías
if($categories->update()){
    echo json_encode(
        array('message' => 'Categoría Modificada')
    );
}else{
    echo json_encode(
        array('message' => 'Categoría no Modoficada')
    );
}

