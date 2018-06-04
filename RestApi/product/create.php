<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate note object
include_once '../objects/notes.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Notes($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set note property values
$product->title = $data->title;
$product->tag = $data->tag;
$product->content = $data->content;
$product->created = date('Y-m-d H:i:s');
$product->modified = date('Y-m-d H:i:s');
 
// create the note
if($notes->create()){
    echo '{';
        echo '"message": "Note was created."';
    echo '}';
}
 
// if unable to create the note, tell the user
else{
    echo '{';
        echo '"message": "Unable to create note."';
    echo '}';
}
?>