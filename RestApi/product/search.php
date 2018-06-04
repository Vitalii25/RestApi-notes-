<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/notes.php';
 
// instantiate database and notes object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$notes = new Notes($db);
 
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
 
// query notes
$stmt = $notes->search($keywords);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // notes array
    $notes_arr=array();
    $notes_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $note_item=array(
            "id" => $id,
            "title" => $title,
            "tag" => $tag,
            "content" => $content
        );
 
        array_push($notes_arr["records"], $notes_item);
    }
 
    echo json_encode($notes_arr);
}
 
else{
    echo json_encode(
        array("message" => "No notes found.")
    );
    
    
    // search notes
function search($keywords){
 
    // select all query
    $query = "SELECT
            n.id, n.title, n.tag, n.content, n.created, p.modified
            FROM
                " . $this->table_name . " n
            WHERE
                n.title LIKE ? OR n.tag LIKE ? OR c.title LIKE ?
            ORDER BY
                n.created DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
    
    
    
}
?>