<?php
    require_once __DIR__ . '/../../php/utilities.php';
    require_once __DIR__ . '/../../php/Controllers/CategoryController.php';

    checkSession();
    $conn = startConnection();

    $categoryController = new CategoryController($conn);

    $categories = $categoryController->index();

    if(isset($_POST['delete'])) {
        $categoryController->delete($_POST['delete']);
        header("Location: ./index.php");
    }

    if(isset($_POST['name'])) {
        $categoryController->store($_POST['name']);
        header("Location: ./index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <title>Products - Boolgram</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../index.php">Boolgram</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../Posts/index.php" class="nav-link">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php" class="nav-link active">Categories</a>
                    </li>
                </ul>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="fw-medium ">Welcome</span> <?php echo $_SESSION['username'] ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <div class="row justify-content-center ">
                <div class="col-6 card p-4 rounded-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="mb-3">Categories</h1>
                        <form id="createForm" class="input-group w-25" action="./index.php" method="POST">
                            <input type="text" class="form-control" id="createInput" name="name">
                            <button class="btn btn-secondary">Add</button>
                        </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($categories as $category) { ?>
                            <tr>
                                <th scope="row" class="py-3"><?php echo $category->id ?></th>
                                <td scope="row" class="py-3"><?php echo $category->name ?></td>
                                <td class="text-end">
                                    <form action="./index.php" method="POST" class="d-inline">
                                        <input class="d-none" type="text" name="delete" value="<?php echo $category->id ?>">
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Inline Script -->
        <script>
            // Create Validation
            document.getElementById("createForm").addEventListener("submit", function(e) {

                e.preventDefault();

                var inputValue = document.getElementById("createInput").value;

                if (inputValue.trim() !== "") {
                    this.submit();
                } else {
                    alert("The input field cannot be empty!");
                }
            });
        </script>
    </body>
</html>