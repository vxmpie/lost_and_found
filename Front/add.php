<?php
    error_reporting(0);
    session_start();
    if(isset($_SESSION['user_status']) && !empty($_SESSION['user_status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Item</title>

     <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Include your custom CSS -->
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="addDesign.css">
    <link rel="stylesheet" href="designset.css">
    <link rel="stylesheet" href="Thankyou.css">

</head>
<body>

  <div class="foundify" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
        <a style="flex-grow: 1; text-align: center;">Foundify</a>
        <label class="switch">
            <input type="checkbox" id="toggleMode">
            <span class="slider"></span>
        </label>
    </div>


    <div class="container mt-5">
        <form action="insert.php" method="POST" enctype="multipart/form-data" id="yourFormId" class="container d-flex flex-column align-items-center justify-content-center was-validated" style="height: 100vh; padding-top: 20px;">
            <!-- ชื่อ -->
            <div class="col-md-5 mb-3" style="padding-top: 10px;">
                <label for="title" class="form-label">Name</label>
                <input type="text" class="form-control formSearch" name="title" id="title" placeholder="Enter title" required>
                <div class="valid-feedback">
                Looks good!
            </div>
            </div>

              <!-- ไฟล์ -->
            <div class="col-md-5 mb-3" style="padding-top: 10px;">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control formSearch" name="image" id="image" required>
            </div>


            <!-- คำอธิบาย -->
            <div class="col-md-5 mb-3" style="padding-top: 10px;">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control formSearch" name="description" id="description" placeholder="Enter description" required>
            </div>

            

            <!-- วันที่ -->
            <div class="col-md-5 mb-3" style="padding-top: 10px;">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control formSearch" name="date" id="date" required>
            </div>

            <!-- สถานที่พบ -->
            <div class="col-md-5 mb-3" style="padding-top: 10px;">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control formSearch" name="location" id="location" placeholder="Enter location" required>
            </div>

            <!-- ปุ่ม Submit -->
               <div class="col-md-5 mb-3" style="padding-top: 10px; margin-bottom: 25px;">
            <div id="app" >
                <button type="submit" id="postButton" style="border-radius: 10px; padding: 10px; width: 20%;">Post</button>
            </div>
        </div>
    </form>
        </form>
    </div>


      <!-- Modal -->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="Thankyou">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Thank you</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Have a nice day!</p>
                    <div class="button-container">
                        <button id="goToPost">Go to your Post</button>
                        <a href="home.html" class="transparent-btn">
                            Go to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>




     <footer class="footer">
        <div class="container d-flex justify-content-around d-flex2">
            <a href="home.php" id="homeLink" class="footer-icon"><i class="bi bi-house-door-fill"></i></a>
            <a href="search.php" id="searchLink" class="footer-icon"><i class="bi bi-search-heart-fill"></i></a>
            <a href="add.html" id="addLink" class="footer-icon"><i class="bi bi-plus-circle-fill"></i></a>
            <a href="signup_login.html" id="setLink" class="footer-icon"><i class="bi bi-person-fill"></i></a>
        </div>
    </footer>

    <!-- เชื่อมต่อกับ Bootstrap JS -->
       <script src="darkMode.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
     
     <script>
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
    
</body>
</html>
<?php
}
    else{
        header("location: signup_login.php");
    }
?>