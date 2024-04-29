<?php
    require_once __DIR__ . '/php/utilities.php';
    checkSession();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <title>Boolgram</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php">Boolgram</a>
                <?php if(isset($_SESSION['username'])) { ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="./pages/Posts/index.php" class="nav-link">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a href="./pages/Categories/index.php" class="nav-link">Categories</a>
                    </li>
                </ul>
                <?php } ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <?php if(empty($_SESSION['username'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./pages/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pages/register.php">Register</a>
                        </li>
                        <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="fw-medium ">Welcome</span> <?php echo $_SESSION['username'] ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="./pages/logout.php">Logout</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="py-3 pe-3 d-flex justify-content-end">
            <select id="categoriesSelect" class="form-select" style="width: 280px;">
                <option value="" selected>All Categories</option>
            </select>
        </div>

        <div class="container pb-5">
            <div class="row justify-content-center ">
                <!-- // -->
            </div>
        </div>

        <!-- Bootstrap JS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Inline Script -->
        <script>
            // Async function for get posts from API
            async function getPosts(id = '') {
                const params = new URLSearchParams({
                    'id': id,
                });
                let response = await fetch(`http://localhost/week2/api/Posts/index.php/posts?${params}`);
                let data = response.json();
                return data;
            }

            // Async function for get categories from API
            async function getCategories() {
                let response = await fetch('http://localhost/week2/api/Categories/index.php/categories');
                let data = response.json();
                return data;
            }

            // Get all posts
            getPosts().then( posts => {
                displayPosts(posts);
            });

            // Display all posts with cards
            function displayPosts(posts) {

                const wrapper = document.getElementsByClassName('row')[0];
                wrapper.innerHTML = '';

                posts.forEach( post => {
                    const card = document.createElement('div');
                    card.classList.add('col-8');
                    card.innerHTML = `
                        <div class="card mb-3">
                            <img src="${post.image}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">${post.title} <span class="badge rounded-pill text-bg-secondary">${post.category_name}</span></h5>
                                <p class="card-text">${post.content.slice(0, 20)}</p>
                            </div>
                        </div>
                    `
                    wrapper.append(card);
                });
            }

            // Select filter
            const select = document.getElementById('categoriesSelect')

            // Get all categories
            getCategories().then( categories => {

                // Add categories on select filter
                categories.forEach( category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    select.append(option);
                })
            });

            // Event listener for category filter
            select.addEventListener('change', function() {
                console.log('change')
                getPosts(this.value).then( posts => {
                    displayPosts(posts);
                });
            })

        </script>
    </body>
</html>