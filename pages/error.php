<?php header( "refresh:4; url=../index.php" ); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Error - Boolgram</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Boolgram</a>
        </div>
    </nav>

    <main class="d-flex flex-column justify-content-center align-items-center" style="width: 100vw; height: calc(100vh - 80px);">
        <h1 class="mb-4">Ops! Something is not working right.</h1>
        <a href="../index.php"><button class="btn btn-primary btn-lg rounded-4">Homepage</button></a>
    </main>
</body>
</html>