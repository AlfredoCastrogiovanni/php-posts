<?php
    require_once __DIR__ . '/../../php/utilities.php';
    require_once __DIR__ . '/../../php/Controllers/PostController.php';
    require_once __DIR__ . '/../../php/Controllers/CategoryController.php';

    checkSession();
    $conn = startConnection();

    $postController = new PostController($conn);
    $categoryController = new CategoryController($conn);

    $categories = $categoryController->index();

    if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['image']) && isset($_POST['category_id'])) {

        $postController->store($_POST['title'], $_POST['content'], $_POST['image'], $_SESSION['id'], $_POST['category_id']);

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
        <title>Edit Post - Boolgram</title>
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
            <div class="row justify-content-center ">
                <form id="createForm" class="row col-6 border border-secondary-subtle rounded-4 p-4" action="./create.php" method="POST">
                    <div class="col-12 mb-3">
                        <h2>New Post</h2>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <div id="title" class="invalid-feedback">
                            Please provide a valid title.
                        </div>
                    </div>
                    <div class="col-8 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="text" class="form-control" id="image" name="image">
                        <div id="image" class="invalid-feedback">
                            The input field cannot be empty!
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" class="form-select" name="category_id">
                            <option selected></option>
                            <?php foreach($categories as $category) { ?>
                            <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                            <?php } ?>
                        </select>
                        <div id="category_id" class="invalid-feedback">
                            Select a valid category.
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="4"></textarea>
                        <div id="content" class="invalid-feedback">
                            The input field cannot be empty!
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bootsrap JS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Inline Script -->
        <script>
            // Create Validation
            document.getElementById('createForm').addEventListener('submit', function(e) {

                e.preventDefault();
                let validated = true;

                const title = document.getElementById('title');
                const content = document.getElementById('content');
                const image = document.getElementById('image');
                const category_id = document.getElementById('category_id');

                if(title.value.trim() == '') {
                    validated = false;
                    title.classList.add('is-invalid');
                } else {
                    title.classList.remove('is-invalid');
                }

                if(content.value.trim() == '') {
                    validated = false;
                    content.classList.add('is-invalid');
                } else {
                    content.classList.remove('is-invalid');
                }

                if(image.value.trim() == '') {
                    validated = false;
                    image.classList.add('is-invalid');
                } else {
                    image.classList.remove('is-invalid');
                }

                if(category_id.value.trim() == '') {
                    validated = false;
                    category_id.classList.add('is-invalid');
                } else {
                    category_id.classList.remove('is-invalid');
                }

                validated ? this.submit() : '';
            });
        </script>
    </body>
</html>