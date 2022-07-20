<?php
/* Se crearan los diferentes CRUD de la tabla de productos de la base de datos, 
mediante una clase que las contenga por medio de metodos o funciones */

//Creacion de la clase contenedora 

class classProducts

{
    //propiedades que deben ser privadas la conexion y el nombre de la tabla a aplicar en las Querys

    //Conexion a la db
    private $conn;
    //nombre de la tabla 
    private $db_table = "products";

    //propiedades que deben ser publicas: las variables que contiene la tabla 
    public $id;
    public $title;
    public $text;
    public $creation_date;
    public $categorie_id;
    public $categorie_name;

    //se debe realizar la conexion a la base de datos por medio de un constructor 
    public function __construct($db)
    {   //ojo a db
        $this->conn = $db;
    }
    //Query de lectura general
    public function search()
    {   //ojo
        $query_search = 'SELECT cat.name  AS categorie_name, pro.id, pro.title, pro.text, pro.creation_date, pro.categorie_id 
        FROM '. $this->db_table  .'pro LEFT JOIN categories cat ON pro.categorie_id = cat.id ORDER BY pro.creation_date DESC';
        $stmt_search = $this->conn->query($query_search);
        $stmt_search->execute();
        $table_result_search = $stmt_search->fetchAll(PDO::FETCH_OBJ);
        return $table_result_search;
    }

    //query de lectura individual 
    public function search_one()
    {   //ojo
        $query_search = 'SELECT cat.name  AS categorie_name, pro.id, pro.title, pro.text, pro.creation_date, pro.categorie_id 
        FROM '. $this->db_table  .'pro LEFT JOIN categories cat ON pro.categorie_id = cat.id WHERE pro.id = :id LIMIT 0,1';
        $stmt_search = $this->conn->query($query_search);
        $stmt_search->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt_search->execute();
        $table_result_search = $stmt_search->fetchAll(PDO::FETCH_OBJ);

        $this->id = $table_result_search->id;
        $this->title = $table_result_search->title;
        $this->text = $table_result_search->text;
        $this->creation_date = $table_result_search->creation_date;
        $this->categorie_name = $table_result_search->categorie_name;
        $this->categorie_id = $table_result_search->categorie_id;
    }

    //query para insertan a base de datos 
    public function insert()
    {   //ojo
        $query_insert = 'INSERT INTO ' . $this->db_table . ' (title, text, categorie_id) 
        VALUES (:title, :text, :categorie_id)';
        $stmt_insert = $this->conn->prepare($query_insert);

        //validacion de input con dato
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->text = htmlspecialchars(strip_tags($this->text));
        $this->categorie_id = htmlspecialchars(strip_tags($this->categorie_id));
        
        //Vincular el parametro que viene del input 
        $stmt_insert->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt_insert->bindParam(':text', $this->text, PDO::PARAM_STR);
        $stmt_insert->bindParam(':categorie_id', $this->categorie_id, PDO::PARAM_INT);

        //Si se escucja la queri insertar y devolver  un true 
        if ($stmt_insert->excute()) {
            return true;
        } else {
            //preguntas a GIAN
            //printf("Error $s.\n", $stmt_insert->error); 
            return false;
        }
    }

    //METODO ACTUALIZAR 
    public function update()
    {   //ojo
        $query_update = 'UPDATE ' . $this->db_table . ' SET title = :title, text = :text, categorie_id = :categorie_id WHERE id = :id';
        $stmt_update = $this->conn->prepare($query_update);

        //validacion de input con dato
        $stmt_update->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt_update->bindParam(':text', $this->text, PDO::PARAM_STR);
        $stmt_update->bindParam(':categorie_id', $this->categorie_id, PDO::PARAM_INT);

        //Vincular el parametro que viene del input 
        $stmt_update->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt_update->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt_update->bindParam(':text', $this->text, PDO::PARAM_STR);
        $stmt_update->bindParam(':categorie_id', $this->categorie_id, PDO::PARAM_INT);

        //Si se escucja la queri updatear y devolver  un true 
        if ($stmt_update->excute()) {
            return true;
        } else {
            //preguntas a GIAN
            //printf("Error $s.\n", $stmt_update->error); 
            return false;
        }
    }

    //METODO DELETE BORRAR CATEGORIA
    public function delete()
    {   //ojo
        $query_delete = 'DELETE FROM ' . $this->db_table . 'WHERE id = :id';
        $stmt_delete = $this->conn->prepare($query_delete);

        //validacion de input con dato
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Vincular el parametro que viene del input 
        $stmt_delete->bindParam(':id', $this->id, PDO::PARAM_INT);


        //Si se escucja la queri deletear y devolver   true 
        if ($stmt_delete->excute()) {
            return true;
        } else {
            //preguntas a GIAN
            //printf("Error $s.\n", $stmt_delete->error); 
            return false;
        }
    }
}
