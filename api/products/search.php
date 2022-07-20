<?php 

//Encabezados (Header de una api)

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//incluir conexion a la base de datos 
include_once '../../config/connection_mysql.php';
include_once '../../models/products.php';
/* 
//instanciamos clase, que contiene la base de datos y conexion 

$classConnection_mysql= new classConnection_mysql();
$db = $classConnection_mysql->connect();

//se instancia el primer objeto de la clase de metodos que se encuentran en categorias (search)

$classCategories = new classCategories($db);

$result = $classCategories->search();
//var_dump($result);

//contar Filas
$num = $result->rowCount(); #<- cuenta el numero de datos que tiene el array 

if ($num > 0) 
{
    //array de categoria
    $categorie_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {   
        //var_dump($row);
        //extract($row);
        $categorie_item = array
        (
            'id' => $id,
            'nombre' => $name
        );
        //enviar datos por medio de array_push
        array_push($categorie_arr['data'], $categorie_item); 
         
    }

     #enviar el formato de envio 

     //echo json_encode($categorie_arr);
     

}else {
    //envio de error 
    echo json_encode(array('message' => "No hay categorias"));
} */



//metodo con OBJ
########---------------------------------------------------------------------------------------------------------------###################

//instanciamos clase, que contiene la base de datos y conexion 

$classConnection_mysql= new classConnection_mysql();
$db = $classConnection_mysql->connect();

//se instancia el primer objeto de la clase de metodos que se encuentran en categorias (search)

$products = new classProducts($db);

$result = $products->search();

//var_dump($result);

if (!empty($result)) 
{
    //array de categoria
    

    $products_arr['data'] = $result;
    
 
     #enviar el formato de envio 
     echo json_encode($products_arr);
     
}else {
    //envio de error 
    print_r (json_encode(array('message' => "No hay productos")));
} 
?>
 


?>