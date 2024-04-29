<?php
    require_once __DIR__ . '/../../php/utilities.php';
    require_once __DIR__ . '/../../php/Controllers/PostController.php';
    require_once __DIR__ . '/../../php/Controllers/CategoryController.php';

    checkSession();
    $conn = startConnection();

    $postController = new PostController($conn);
    $categoryController = new CategoryController($conn);

    $posts = $postController->index($_SESSION['id']);

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
        <title>Products - Boolgram</title>
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
            <div class="row">
                <div class="col-12 card p-4 rounded-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="mb-3">Posts</h1>
                        <div><a href="./create.php"><button class="btn btn-secondary">New Post</button></a></div>
                    </div>
                    <?php if($posts != []) { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($posts as $post) { ?>
                            <tr>
                                <th scope="row" class="py-3"><?php echo $post->id ?></th>
                                <td class="py-3"><?php echo $post->title ?></td>
                                <td class="py-3"><?php echo substr($post->content, 0, 40) . '...' ?></td>
                                <td class="py-3"><?php echo $categoryController->show($post->category_id)['name'] ?></td>
                                <td class="text-end">
                                    <form action="./show.php" method="GET" class="d-inline">
                                        <input class="d-none" type="text" name="show" value="<?php echo $post->id ?>">
                                        <button class="btn btn-primary">Show</button>
                                    </form>
                                    <form action="./edit.php" method="POST" class="d-inline">
                                        <input class="d-none" type="text" name="edit" value="<?php echo $post->id ?>">
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
                                                    Are you sure you want delete <span class="fw-medium "><?php echo $post->title ?></span>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form action="./index.php" method="POST" class="d-inline">
                                                        <input class="d-none" type="text" name="delete" value="<?php echo $post->id ?>">
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php } else { ?>
                    <div class="p-4 text-center">
                        <h2 class="text-uppercase text-secondary ">There's no post available</h2>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>