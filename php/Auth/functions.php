<?php

function register($username, $password, $conn) {

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $parametricQuery = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $parametricQuery->bind_param('ss', $username, $hash);

    if(!$parametricQuery->execute()) {
        header("Location: ./error.php");
    }

    header("Location: ./login.php");
}

function login($username, $password, $connection) {

    $parametricQuery = $connection->prepare("SELECT * FROM `users` WHERE `username` = ?");
    $parametricQuery->bind_param('s', $username);
    $parametricQuery->execute();
    $results = $parametricQuery->get_result();

    if ($results->num_rows > 0) {
        $row = $results->fetch_assoc();

        if(password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: ../index.php");
        }
    } else {
        return false;
    }
}