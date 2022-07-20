<?php
//Encabezados (Header de una api
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: PUT');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//incluir conexion a la base de datos 
include_once '../../config/connection_mysql.php';
include_once '../../models/products.php';


//Instancionamos la base de datos y conexión
$baseDatos = new classConnection_mysql();
$db = $baseDatos->connect();

//Instanciamos el objeto categoría
$products = new classProducts($db);

// SE obtienen los datos por ingresar a la api
$products->id = isset($_GET['id']) ? $_GET['id'] : die();
$data = json_decode(file_get_contents("php://input"));

$products->title = $data->title;
$products->text = $data->text;
$products->categorie_id = $data->categorie_id;
//Crear Productos
if($products->update()){
    echo json_encode(
        array('message' => 'Producto Modificada')
    );
}else{
    echo json_encode(
        array('message' => 'Producto no Modoficada')
    );
}

