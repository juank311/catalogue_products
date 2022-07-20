<?php
/* Se crearan los diferentes CRUD de la tabla de categorias de la base de datos, 
mediante una clase que las contenga por medio de metodos o funciones */

//Creacion de la clase contenedora 



class classCategories
{
    //propiedades que deben ser privadas la conexion y el nombre de la tabla a aplicar en las Querys

    //Conexion a la db
    private $conn;
    //nombre de la tabla 
    private $db_table = "categories";

    //propiedades que deben ser publicas: las variables que contiene la tabla 
    public $id;
    public $name;   
    public $creation_name;

    //se debe realizar la conexion a la base de datos por medio de un constructor 
    public function __construct($db)
    {   //ojo a db
       $this->conn = $db;
    }
    //Query de lectura general
    public function search()
    {   //ojo
        $query_search = 'SELECT id , name, creation_date FROM '.$this->db_table.' ORDER BY creation_date DESC';
        $stmt_search = $this->conn->query($query_search);
        $stmt_search->execute();
        $result = $stmt_search->fetchAll(PDO::FETCH_OBJ);
        return $result;
        
  /*       public function search($name, $id)
        {   //ojo
            $query_search = 'SELECT '.$id.','.$name.',creation_date FROM '.$this->db_table.' ORDER BY creation_date DESC';
            $stmt_search = $this->conn->query($query_search);
            $stmt_search->execute();
            $result = $stmt_search->fetchAll(PDO::FETCH_OBJ);
            return $result; */
            
    }

    

    //query de lectura individual 
    public function search_one()
    {   
        $query_search = 'SELECT * FROM '.$this->db_table. ' WHERE id = :id';
        $stmt_search = $this->conn->prepare($query_search);
        $stmt_search->bindParam(':id', $this->id); //el numero 1 es la posicion del signo de interrogacion 
        $stmt_search->execute();
        $table_result_search = $stmt_search->fetch(PDO::FETCH_ASSOC);
        
        $this->id = $table_result_search['id'];
        $this->name = $table_result_search['name'];
        $this->creation_date = $table_result_search['creation_date'];
    }

    //query para insertan a base de datos 
    public function insert(){
        //Crear query
        $query = 'INSERT INTO ' . $this->db_table . '(name)VALUE(:name)';           

        //Preparar la sentencia
        $stmt = $this->conn->prepare($query);

        //Limpiar datos
        $this->name = htmlspecialchars(strip_tags($this->name));

        //Vincular parámetro
        $stmt->bindParam(":name", $this->name);

        //Ejecutar query
        if($stmt->execute()){
            return true;
        }

        //Si hay error
        printf("Error %s.\n", $stmt->error); 
        return false;          
    }

    //METODO ACTUALIZAR 
    public function update()
    {   //ojo
        $query_update = 'UPDATE ' .$this->db_table. ' SET name = :name WHERE id = :id';
        $stmt_update = $this->conn->prepare($query_update);
        
        //validacion de input con dato
        $this->name = htmlspecialchars(strip_tags($this->name));

        //Vincular el parametro que viene del input 
        $stmt_update->bindParam(':id', $this->id);
        $stmt_update->bindParam(':name', $this->name, PDO::PARAM_STR);

        //Si se escucja la queri updatear y devolver  un true 
        if ($stmt_update->execute()) 
        {
            return true;
        }else
        {
            //preguntas a GIAN
            //printf("Error %s.\n", $stmt_update->error); 
            return false;
        }
    }

    //METODO DELETE BORRAR CATEGORIA
    public function delete()
    {   //ojo
        $query_delete = 'DELETE FROM ' .$this->db_table. ' WHERE id = :id';
        $stmt_delete = $this->conn->prepare($query_delete);
        
        //validacion de input con dato
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Vincular el parametro que viene del input 
        $stmt_delete->bindParam(':id', $this->id, PDO::PARAM_INT);
        

        //Si se escucja la queri deletear y devolver  un true 
        if ($stmt_delete->execute()) 
        {
            return true;
        }else
        {
            //preguntas a GIAN
           //printf("Error $s.\n", $stmt_delete->error); 
            return false;
        }
    }
}


?>