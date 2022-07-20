<?php
//Encabezados (Header de una api
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: POST');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//incluir conexion a la base de datos 
include_once '../../config/connection_mysql.php';
include_once '../../models/products.php';


//Instancionamos la base de datos y conexión
$baseDatos = new classConnection_mysql();
$db = $baseDatos->connect();

//Instanciamos el objeto categoría
$products = new classProducts($db);

$data = json_decode(file_get_contents("php://input"));

$products->title = $data->title;
$products->text = $data->text;
$products->categorie_id = $data->categorie_id;
//

//Crear categorías
if($products->insert()){
    echo json_encode(
        array('message' => 'Producto creado')
    );
}else{
    echo json_encode(
        array('message' => 'Producto no creado')
    );
}

