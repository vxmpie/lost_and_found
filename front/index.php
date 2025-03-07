<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
error_reporting(0);

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Include your custom CSS -->
    <link rel="stylesheet" href="css/design.css">
    <link rel="stylesheet" href="css/addDesign.css">
    <link rel="stylesheet" href="css/designset.css">
    <link rel="stylesheet" href="css/profile.css">  
    <!-- <link rel="stylesheet" href="css/design_login.css"> -->
</head>

<body class="body">
    <div class="foundify" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
        <a style="flex-grow: 1; text-align: center;">Foundify</a>
        <label class="switch">
            <input type="checkbox" id="toggleMode">
            <span class="slider"></span>
        </label>
    </div>

    <!-- เพิ่ม padding ให้กับ body หรือ container -->
    <div class="container" style="padding-top: 20px; padding-bottom: 80px;">
        <div id="itemsContainer"></div>

        <footer class="footer">
            <div class="container justify-content-around">
                <?php 
                    switch($_GET['page']) {
                        case "home": 
                            require_once 'index.php';
                            break;
                        case "search": 
                            require_once 'search.php';
                            break;
                        case "add":
                            require_once 'add.php';
                            break;
                        case "signup":
                            require_once 'signup_login.php';
                            break;
                        case "post":
                            require_once 'post.php';
                            break;
                        default: 
                            // require_once 'index.php';
                            break;
                    }
                ?>
    <div class="container" style="padding-top: 20px; padding-bottom: 80px;">
        <div id="itemsContainer">
        </div>

        <footer class="footer">
            <div class="container d-flex justify-content-around d-flex2">
                <a href="?page=home" id="indexLink" class="footer-icon"><i class="bi bi-house-door-fill"></i></a>
                <a href="?page=search" id="searchLink" class="footer-icon"><i class="bi bi-search-heart-fill"></i></a>
                <a href="?page=add" id="addLink" class="footer-icon"><i class="bi bi-plus-circle-fill"></i></a>
                <a href="?page=signup" id="setLink" class="footer-icon"><i class="bi bi-person-fill"></i></a>
            </div>
        </footer>
    </div>
    </div>
    <?php
    
    // echo "https://", $_SERVER['HTTP_HOST'], "/back/api/home.php";
    
    ?>

    <script src="js/darkMode.js"></script>
    <script src="js/home.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('<?php echo "http://", $_SERVER['HTTP_HOST'], "/back/api/home.php"; ?>')
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('itemsContainer');
                    data.forEach(item => {
                        const itemCard = document.createElement('a');
                        itemCard.href = `?page=post&id=${item.id}`;
                        itemCard.style.textDecoration = 'none';
                        itemCard.style.color = 'inherit';
                        itemCard.innerHTML = `
                            <div class="card mb-3 mx-auto my-card font">
                                <div class="row g-0">
                                    <div class="col-md-4" style="height: 250px; display: flex; align-items: center;">
                                        <img src="../back/api/uploads/${item.image}" class="img-fluid rounded-start" alt="" style="height: 100%; width: 100%; object-fit: cover; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    </div>
                                    <div class="col-md-8">  
                                        <div class="card-body d-flex flex-column justify-content-between" style="min-height: 200px;">
                                            <h2 class="card-title">${item.name}</h2>
                                            <p class="card-text flex-grow-1">${item.description}</p>
                                            <div>
                                                <div class="my-textTime my-textfont">
                                                    <i class="bi bi-calendar-fill font" style="margin-right: 5px;"></i> ${item.date}
                                                </div>
                                                <div class="my-textTime my-textfont">
                                                    <i class="bi bi-geo-alt-fill font" style="margin-right: 5px;"></i> ${item.location}
                                                </div>
                                                <div class="my-textPost">
                                                    <i class="bi bi-clock-fill font" style="margin-right: 5px;"></i> โพสต์เมื่อ: ${item.created_at}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        container.appendChild(itemCard);
                    });
                });
        });
    </script>
</body>

</html>