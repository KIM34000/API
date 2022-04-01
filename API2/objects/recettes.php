<?php
class Recettes{
  
    // database connection and table name
    private $conn;
    //private $table_name = "recettes";
  
    // object properties
    public $Id;
    public $date_de_création;
    public $nom_de_la_recette;
    public $difficulté;
    public $nombre_de_personnne;
    public $état;
    public $temps;
    public $Id_Utilisateurs;
    public $Id_Images;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
  
    // select all query
    $query = "SELECT * FROM recettes";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
}
?>