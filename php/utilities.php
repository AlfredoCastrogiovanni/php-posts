<?php

require_once __DIR__ . '/constants.php';

function startConnection() {
    $connection = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ( $connection && $connection->connect_error){
        var_dump("Failed connection with the database, with error $connection->connect_error" );
    }

    return $connection;
}

function checkSession() {
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }
}