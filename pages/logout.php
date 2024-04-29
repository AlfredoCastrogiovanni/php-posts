<?php
    require_once __DIR__ . '/../php/utilities.php';

    checkSession();
    session_unset();
    session_destroy();
    
    header( "refresh:3; url=../index.php" );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Logout - Boolgram</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Boolgram</a>
        </div>
    </nav>

    <main class="d-flex justify-content-center align-items-center" style="width: 100vw; height: calc(100vh - 80px);">
        <h1>You have been logged out successfully!</h1>
    </main>
</body>
</html>