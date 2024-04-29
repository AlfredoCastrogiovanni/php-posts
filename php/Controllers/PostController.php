<?php
require_once __DIR__ . '/../models/Post.php';

class PostController {
    public $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function index($id) {

        $parametricQuery = $this->conn->prepare("SELECT * FROM posts WHERE user_id = ?");
        $parametricQuery->bind_param('i', $id);
        $parametricQuery->execute();

        $results = $parametricQuery->get_result();

        $posts = [];


        while($row = $results->fetch_assoc()) {
            $posts[] = new Post($row['id'],$row['title'], $row['content'], $row['image'], $row['user_id'], $row['category_id']);
        }
        
        return $posts;
    }

    public function store(String $title, String $content, String $image, int $user_id, int $category_id) {

        $parametricQuery = $this->conn->prepare("INSERT INTO posts (title, content, image, user_id, category_id) VALUES (?, ?, ?, ?, ?)");
        $parametricQuery->bind_param('sssii', $title, $content, $image, $user_id, $category_id);

        if(!$parametricQuery->execute()) {
            header("Location: ../error.php");
        }
    }

    public function show($id) {

        $parametricQuery = $this->conn->prepare("SELECT * FROM `posts` WHERE `id` = ?");
        $parametricQuery->bind_param('i', $id);
        $parametricQuery->execute();

        $results = $parametricQuery->get_result();

        return $results->fetch_assoc();
    }

    public function update(int $id, String $title, String $content, String $image, int $user_id, int $category_id) {

        $parametricQuery = $this->conn->prepare("UPDATE posts SET title = ?, content = ?, image = ?, user_id = ?, category_id = ? WHERE id = ?");
        $parametricQuery->bind_param('sssiii', $title, $content, $image, $user_id, $category_id, $id);
        $parametricQuery->execute();
    }

    public function delete($id) {

        $parametricQuery = $this->conn->prepare("DELETE FROM `posts` WHERE `id` = ?");
        $parametricQuery->bind_param('i', $id);
        $parametricQuery->execute();
    }
}