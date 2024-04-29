<?php
    require_once __DIR__ . '/../../php/utilities.php';

    checkSession();
    $conn = startConnection();

    switch ($requestMethod) {
        case 'GET':
            $query = 'SELECT * FROM categories';
            $results = $conn->query($query);

            $categories = [];

            while($row = $results->fetch_assoc()) {
                array_push($categories, [
                    'id' => $row['id'],
                    'name' => $row['name'],
                ]);
            }

            echo json_encode($categories);

            break;
        case 'POST':
            //
            break;
        default:
            http_response_code(405);
            echo 'Invalid method';
    }
?>