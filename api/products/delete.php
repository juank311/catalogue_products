<?php
//Encabezados (Header de una api
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: DELETE');
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

//Borrar categoría
if($products->delete()){
    echo json_encode(
        array('message' => 'Producto Borrado Exitosamente')
    );
}else{
    echo json_encode(
        array('message' => 'Producto NO Borrado con Exito')
    );
}

