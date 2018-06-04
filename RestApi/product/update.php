<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/notes.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare notes object
$notes= new Notes($db);
 
// get id of notes to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of notes to be edited
$notes->id = $data->id;
 
// set notes property values
$notes->title = $data->title;
$notes->tag = $data->tag;
$notes->content = $data->content;
$notes->created = $data->created;
$notes->modified = $data->modified;
 
// update the notes
if($notes->update()){
    echo '{';
        echo '"message": "Note was updated."';
    echo '}';
}
 
// if unable to update the notes, tell the user
else{
    echo '{';
        echo '"message": "Unable to update notes."';
    echo '}';
    
    
    
    
    // update the note
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                title = :title,
                tag = :tag,
                content = :content
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->tag=htmlspecialchars(strip_tags($this->tag));
    $this->content=htmlspecialchars(strip_tags($this->content));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':tag', $this->tag);
    $stmt->bindParam(':content', $this->content);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }
     
    
}
?>