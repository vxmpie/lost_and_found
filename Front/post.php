<!DOCTYPE html>
<html lang="en">
  
<?php
    require "db_connect.php";       
    session_start(); 
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>

     <!-- Include Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Include your custom CSS -->
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="addDesign.css">

</head>

<?php
          $sql_select_post = "SELECT * FROM items WHERE items.id = '".$_GET['id']."'"; 
          $resuut_select_post = $dbo->query("$sql_select_post")->fetch();   
          $sql_select_user = "SELECT email FROM users WHERE users.id = '{$resuut_select_post['owner']}'";                    
          $query_select_user = $dbo->query("$sql_select_user")->fetch();   
      ?>

<body>

  <div class="foundify2" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
    <i class="bi bi-chevron-left" onclick="window.history.back();" style="cursor: pointer;"></i>
    <a style="flex-grow: 1; text-align: center; margin: 0;">Foundify</a>
    <i class="bi bi-flag-fill" onclick="window.location.href='report.html';" style="margin-left: auto; padding-right: 20px;"></i>
  </div>
    
    <div style="padding: 20px; display: flex; align-items: center; justify-content: center;">
        <div  id="postTitle" style="font-size: 40px; font-weight: bold; padding-top: 100px; padding-bottom : 30px;"></div>        
        <div class="card backgroundCard" style="max-width: 50%; border-radius: 15px; padding: 20px;">
            <img src="/MobileProject/image/<?php echo $resuut_select_post['image'];?>" id="postImage"  class="card-img-top" style=" background-color: transparent; padding: 20px; border-radius: 30px;">
            <div class="card-body">          
                
              <h2 class="card-title"><?php echo $resuut_select_post['title'];?></h2>
              <p id="postSubtitle" class="card-title"><?php echo $resuut_select_post['description'];?></p>
                    
                    <div class="font">
                        <i class="bi bi-calendar-fill" style="margin-right: 5px; color: rgba(5, 223, 209, 0.829)"></i>
                        <span id="postDate"><?php echo $resuut_select_post['date'];?></span>
                    </div>
                    
                    <div class="font">
                        <i class="bi bi-geo-alt-fill" style="margin-right: 5px;color: rgba(5, 223, 209, 0.829)"></i>
                        <span id="postLocation"><?php echo $resuut_select_post['location'];?></span>
                    </div>

                     <!-- เพิ่มวันที่และเวลาโพสต์ (โพสต์เมื่อ) -->
                    <div id="postPostedDateTime" class="my-textPost">
                      <!-- วันที่และเวลาโพสต์จะแสดงที่นี่ -->
                  </div>

                    <div id="app" style="padding-top: 20px; margin-bottom: 30px;">
                        <button id="contactButton">Contact</button>
                    
                        <div id="contactBox" class="contact-box">
                          <button class="hide-button" onclick="toggleContact()">Hide</button>
                          <div style="font-size: 20px;"><strong>Contact</strong></div>
                          <div>Email: <?php echo $query_select_user['email'];?></div>
                        </div>
                    
                        <div class="backdrop" id="backdrop"></div>
                        <div class="dialog background" id="dialog">
                          <h2>Please Log in</h2>
                          <p>to view contact information.</p>
                          <button onclick="goToLogin()">Go to Account for Log In</button>
                        </div>
                      </div>
                    
          </div>
    </div>
    <footer class="footer">
      <div class="container d-flex justify-content-around d-flex2">
          <a href="home.php" id="homeLink" class="footer-icon"><i class="bi bi-house-door-fill"></i></a>
          <a href="search.php" id="searchLink" class="footer-icon"><i class="bi bi-search-heart-fill"></i></a>
          <a href="add.php" id="addLink" class="footer-icon"><i class="bi bi-plus-circle-fill"></i></a>
          <a href="signup_login.php" id="setLink" class="footer-icon"><i class="bi bi-person-fill"></i></a>
      </div>
  </footer>

   <!-- Contact Button -->
   <?php
   if(isset($_SESSION['user_id'])){
   echo '<script>';
   echo 'const isLoggedIn = true;';
   echo '</script>';
   }
  else{
  echo '<script>';
  echo 'const isLoggedIn = false;';
  echo '</script>';
  }
   ?>  
    <script>
    const contactButton = document.getElementById('contactButton');
    const contactBox = document.getElementById('contactBox');
    const dialog = document.getElementById('dialog');
    const backdrop = document.getElementById('backdrop');

    function toggleContact() {
      const isVisible = contactBox.classList.contains('active');
      contactBox.classList.toggle('active');
      contactButton.style.display = isVisible ? 'inline-block' : 'none';
    }

    function showDialog() {
      dialog.classList.add('active');
      backdrop.classList.add('active');
    }

    function hideDialog() {
      dialog.classList.remove('active');
      backdrop.classList.remove('active');
    }

    function goToLogin() {
      window.location.href = 'signup_login.php';
      hideDialog();
    }

    backdrop.addEventListener('click', hideDialog);

    if (isLoggedIn) {
      contactButton.onclick = toggleContact;
    } else {
      contactButton.textContent = 'Request Founder Contact';
      contactButton.onclick = showDialog;
    }
    

    
     // Footer active link script
        const currentPage = window.location.pathname.split("/").pop(); // ตรวจสอบชื่อไฟล์หน้าเว็บปัจจุบัน
        const links = document.querySelectorAll('.footer-icon'); // เลือกไอคอนทั้งหมดใน footer

        links.forEach(link => {
            link.classList.remove('active'); // ลบคลาส active ออกจากไอคอนทั้งหมด
        });

        // เปลี่ยนคลาส active สำหรับไอคอนที่ตรงกับหน้าเว็บที่เปิด
        if (currentPage === 'home.php') {
            document.getElementById('homeLink').classList.add('active');
        } else if (currentPage === 'search.php') {
            document.getElementById('searchLink').classList.add('active');
        } else if (currentPage === 'add.php') {
            document.getElementById('addLink').classList.add('active');
        } else if (currentPage === 'signup_login.php') {
            document.getElementById('setLink').classList.add('active');
        }
    </script>
    
      <script src="darkMode.js"></script>

</body>
</html>
