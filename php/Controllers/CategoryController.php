<?php
require_once __DIR__ . '/../models/Category.php';

class CategoryController {
    public $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function index() {
        $query = 'SELECT * FROM categories';
        $results = $this->conn->query($query);

        $categories = [];


        while($row = $results->fetch_assoc()) {
            $categories[] = new Category($row['id'], $row['name']);
        }
        
        return $categories;
    }

    public function store(String $name) {

        $parametricQuery = $this->conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $parametricQuery->bind_param('s', $name);

        if(!$parametricQuery->execute()) {
            header("Location: ../error.php");
        }
    }

    public function show($id) {

        $parametricQuery = $this->conn->prepare("SELECT * FROM `categories` WHERE `id` = ?");
        $parametricQuery->bind_param('i', $id);
        $parametricQuery->execute();
        $results = $parametricQuery->get_result();

        return $results->fetch_assoc();
    }

    // // Metodo per aggiornare una risorsa esistente
    // public function updateRisorsa($id, $nome, $descrizione) {
    //     //
    // }

    public function delete($id) {

        $parametricQuery = $this->conn->prepare("DELETE FROM `categories` WHERE `id` = ?");
        $parametricQuery->bind_param('i', $id);
        $parametricQuery->execute();
    }
}