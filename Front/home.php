<?php
    error_reporting(0);
    session_start();    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Include your custom CSS -->
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="addDesign.css">
    <link rel="stylesheet" href="designset.css">

    

</head>
<?php          
     require "db_connect.php";    
    //if(!empty($_SESSION['user_status'])){
?>  

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
            
        <?php
          $sql_select_post = "SELECT * FROM items";
          $query_select_post = $dbo->query("$sql_select_post")->fetchAll();          
          foreach ($query_select_post as $resuut_select_post) {                          
      ?>
            <a href="post.php?id=<?php echo $resuut_select_post['id'];?>" style="text-decoration: none; color: inherit;">
                   <div class="card mb-3 mx-auto my-card font">
                    <div class="row g-0">
                        <div class="col-md-4" style="height: 250px; display: flex; align-items: center;">
                            <img src="/MobileProject/image/<?php echo $resuut_select_post['image'];?>" class="img-fluid rounded-start" alt=""
                                style="height: 100%; width: 100%; object-fit: cover; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column justify-content-between" style="min-height: 200px;">
                                <h2 class="card-title"><?php echo $resuut_select_post['title'];?></h2>
                                <p class="card-text flex-grow-1"><?php echo $resuut_select_post['description'];?></p>
                                <div>                                    
                                    <div class="my-textTime my-textfont">
                                        <i class="bi bi-calendar-fill font" style="margin-right: 5px;"></i> <?php echo $resuut_select_post['date'];?>
                                    </div>
                                    <div class="my-textTime my-textfont">
                                        <i class="bi bi-geo-alt-fill font" style="margin-right: 5px;"></i> <?php echo $resuut_select_post['location'];?>
                                    </div>
                                    <!-- เพิ่มแสดงวันที่และเวลา -->
                                    <div  class="my-textPost">
                                        <i class="bi bi-clock-fill font" style="margin-right: 5px;"></i> โพสต์เมื่อ: <?php echo $resuut_select_post['posted'];?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></a>
          
                <?php
          }
      ?>

            <!-- โค้ดการ์ด -->
            <div id="cardContainer"></div>

            <footer class="footer">
    <div class="container d-flex justify-content-around d-flex2">
        <a href="home.php" id="homeLink" class="footer-icon"><i class="bi bi-house-door-fill"></i></a>
        <a href="search.php" id="searchLink" class="footer-icon"><i class="bi bi-search-heart-fill"></i></a>
        <a href="add.php" id="addLink" class="footer-icon"><i class="bi bi-plus-circle-fill"></i></a>
        <a href="signup_login.php" id="setLink" class="footer-icon"><i class="bi bi-person-fill"></i></a>
    </div>
</footer>
        </div>
    </div>

  


    <script src="darkMode.js"></script>
    <script src="home.js"></script>

    
</body>

</html>
