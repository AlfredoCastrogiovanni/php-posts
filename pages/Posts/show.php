<?php
    require_once __DIR__ . '/../../php/utilities.php';
    require_once __DIR__ . '/../../php/Controllers/PostController.php';
    require_once __DIR__ . '/../../php/Controllers/CategoryController.php';

    checkSession();
    $conn = startConnection();

    $postController = new PostController($conn);
    $categoryController = new CategoryController($conn);

    $post = $postController->show($_GET['show']);

    if(isset($_POST['delete'])) {
        $postController->delete($_POST['delete']);
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
        <title>Product - Boolgram</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../index.php">Boolgram</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="./index.php" class="nav-link active">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a href="../Categories/index.php" class="nav-link">Categories</a>
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
            <div class="row rounded-4 border border-secondary-subtle p-4">
                <div class="col-6 d-flex align-items-center pe-4">
                    <img class="img-fluid " src="<?php echo $post['image'] ?>">
                </div>
                <div class="col-6">
                    <h2 class="mb-3"><?php echo $post['title'] ?> <span class="badge text-bg-dark"><?php echo $categoryController->show($post['category_id'])['name'] ?></span></h2>
                    <p class="mb-1 fw-medium ">Description:</p>
                    <p><?php echo $post['content'] ?></p>
                </div>
                <div class="col-12 text-end">
                    <form action="./edit.php" method="POST" class="d-inline">
                        <input class="d-none" type="text" name="edit" value="<?php echo $post['id'] ?>">
                        <button class="btn btn-success">Edit</button>
                    </form>

                    <!-- Modal button -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-danger" id="modalLabel">Delete</h1>
                                </div>
                                <div class="modal-body text-start">
                                    Are you sure you want delete <span class="fw-medium "><?php echo $post['title'] ?></span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="./index.php" method="POST" class="d-inline">
                                        <input class="d-none" type="text" name="delete" value="<?php echo $post['id'] ?>">
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>