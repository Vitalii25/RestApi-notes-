<?php

class Notes {

    // database connection and table name
    private $conn;
    private $table_name = "notes";
    // object properties
    public $id;
    public $title;
    public $tag;
    public $content;
    public $created;
    public $modified;

    // constructor with db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read note
    function read() {

        // select all query
        $query = "SELECT
                n.id, n.title, n.tag, n.content, n.created, n.modified
            FROM
                " . $this->table_name . " n
            ORDER BY
                n.created DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    
    
    // create note
function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                title=:title, tag=:tag, content=:content, created=:created, modified=:modified";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->tag=htmlspecialchars(strip_tags($this->tag));
    $this->content=htmlspecialchars(strip_tags($this->content));
    $this->created=htmlspecialchars(strip_tags($this->created));
    $this->modified=htmlspecialchars(strip_tags($this->modified));
 
    // bind values
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":tag", $this->tag);
    $stmt->bindParam(":content", $this->content);
    $stmt->bindParam(":created", $this->created);
    $stmt->bindParam(":modified", $this->modified);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }
    
    
    // used when filling up the update note form
function readOne(){
 
    // query to read single record
  $query = "SELECT
                n.id, n.title, n.tag, n.content, n.created, n.modified
            FROM
                " . $this->table_name . " n
            WHERE
                n.id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->title = $row['title'];
    $this->tag = $row['tag'];
    $this->content = $row['content'];
    $this->created = $row['created'];
    $this->modified = $row['modified'];
    }

}
