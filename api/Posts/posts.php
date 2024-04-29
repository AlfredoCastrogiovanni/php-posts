<?php
    require_once __DIR__ . '/../../php/utilities.php';

    checkSession();
    $conn = startConnection();

    switch ($requestMethod) {
        case 'GET':

            if(isset($_GET['id']) && $_GET['id'] !== '') {
                $query = "SELECT * FROM posts JOIN categories ON posts.category_id = categories.id WHERE posts.category_id = {$_GET['id']}";
                $results = $conn->query($query);
            } else {
                $query = 'SELECT * FROM posts JOIN categories ON posts.category_id = categories.id';
                $results = $conn->query($query);
            }

            $posts = [];

            while($row = $results->fetch_assoc()) {
                array_push($posts, [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'content' => $row['content'],
                    'image' => $row['image'],
                    'user_id' => $row['user_id'],
                    'category_id' => $row['category_id'],
                    'category_name' => $row['name']
                ]);
            }

            echo json_encode($posts);

            break;
        case 'POST':
            //
            break;
        default:
            http_response_code(405);
            echo 'Invalid method';
    }
?>
