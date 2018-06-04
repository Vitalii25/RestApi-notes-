<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/notes.php';

// instantiate database and note object
$database = new Database();
$db = $database->getConnection();

// initialize object
$notes = new Notes($db);

// query notes
$stmt = $notes->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // notes array
    $notes_arr = array();
    $notes_arr["records"] = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $notes_item = array(
            "id" => $id,
            "title" => $title,
            "tag" => html_entity_decode($tag),
            "content" => $content,
            "created" => $created,
            "modified" => $modified
        );

        array_push($notes_arr["records"], $notes_item);
    }

    echo json_encode($notes_arr);
} else {
    echo json_encode(
            array("message" => "No notes found.")
    );
}
?>