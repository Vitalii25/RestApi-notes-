<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/notes.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare note object
$notes = new Notes($db);
 
// set ID property of note to be edited
$notes->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of note to be edited
$notes->readOne();
 
// create array
$notes_arr = array(
    "id" =>  $notes->id,
    "title" => $notes->title,
    "tag" => $notes->tag,
    "content" => $notes->content,
    "created" => $notes->created,
    "modified" => $notes->modified
);
 
// make it json format
print_r(json_encode($notes_arr));
?>