<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/recettes.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$recettes = new Recettes($db);
  
// query recettes
$stmt = $recettes->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // recettes array
    $recettes_arr=array();
    $recettes_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $recettes_item=array(
            "Id" => $Id,
            "date_de_création" => $date_de_création,
            "nom_de_la_recette" => $nom_de_la_recette,
            "difficulté" => $difficulté,
            "nombre_de_personnne" => $nombre_de_personnne,
            "état" => $état,
            "temps" => $temps,
            "Id_Utilisateurs" => $Id_Utilisateurs,
            "Id_Images" => $Id_Images
        );

        array_push($recettes_arr["records"], $recettes_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show recettes data in json format
    echo json_encode($recettes_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no recettes found
    echo json_encode(
        array("message" => "No recettes found.")
    );
}