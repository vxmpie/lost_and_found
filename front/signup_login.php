<?php 
session_start();

?>
<link rel="stylesheet" href="css/design_login.css">
<div class="" style="height: 100%; margin-top: 45%">
<div class="pageset1" id="page1">
        <div>
            <div class="button_sign" id="signButton">
                <i class="bi bi-person-fill"></i>
                <span> Log In / Sign up</span>
            </div>
        </div>
    </div>

    <div class="wrapper" id="signup" style="display:none;">
        <form id="signupForm" action="#">
            <h1 id="login">Sign up</h1>
            <div class="input-box" style="text-align: left;">
                <label for="fname">Name</label>
                <input type="text" name="name" id="signup-Name" placeholder="First Name" required>
            </div>
            <div class="input-box" style="text-align: left;">
                <label for="lName">Username</label>
                <input type="text" name="username" id="signup-Username" placeholder="Last Name" required>
            </div>
            <div class="input-box" style="text-align: left;">
                <label for="email">Email</label>
                <input type="email" name="email" id="signup-email" placeholder="Email" required>
            </div>
            <div class="input-box" style="text-align: left;">
                <label for="password">Password</label>
                <input type="password" name="password" id="signup-password" placeholder="Password" required>
            </div>
            <div style="padding-top: 10px;">
                <input type="submit" class="btn2" id="submit_form" value="Sign Up" name="signUp">
            </div>
        </form>
        <div class="register-link">
            <p>Already Have Account ?</p>
            <button id="signInButton">Log In</button>
        </div>
    </div>

    <div class="wrapper" id="signIn" style="display: none;">
        <form id="loginForm" action="#">
            <h1 id="login">Log in</h1>
            <div class="input-box" style="text-align: left;">
                <label for="email">Email</label>
                <input type="email" name="email" id="signin-email" placeholder="Email" required>
            </div>
            <div class="input-box" style="text-align: left;">
                <label for="password">Password</label>
                <input type="password" name="password" id="signin-password" placeholder="Password" required>
            </div>
            <div style="padding-top: 10px;">
                <input type="submit" class="btn2" value="Log In" id="submit_form" name="signIn">
            </div>
        </form>
        <div class="register-link">
            <p>Don't have an account?</p>
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>

    <div class="wrapper" id="profilepage" style="display: none;">
        <div class="profile-pic">
            <img id="profileImage" src="https://i.pravatar.cc/100" alt="Profile Picture">
            <label for="fileUpload" class="edit-icon">
                <img id="iconup" src="https://cdn-icons-png.flaticon.com/512/711/711191.png" alt="Camera Icon" width="24" height="24">
            </label>
            <input type="file" id="fileUpload" accept="image/*">
        </div>
        <h1>User Profile</h1>
        <p id="profile-info"></p>
        <span id="userNameDisplay">User</span>
        
        <button id="changeNameButton" style="border: none; background: none; cursor: pointer;">
            ✏️
        </button>
        
        <a href="?page=signup&logout=logout" id="logout" style="border: none; background: none; cursor: pointer;">
            ออกจากระบบ
        </a>
    </div>
</div>
<?php 

    if($_GET['logout'] == 'logout') {
        // header("refresh: 5;")
        ?>
        <?php
        unset($_SESSION['username']);
?>

<?php 
    }

    // echo $_SESSION['username'];
    // echo "TEST";
    if(isset($_SESSION['username'])) {
    ?>


<script>
    document.getElementById('profilepage').style.display = 'block';
    document.getElementById('signIn').style.display = 'none';
    document.getElementById('signup ').style.display = 'none';
</script>
<?php 
} else 

{

?>

<script>
    document.getElementById('signIn').style.display = 'block';
// document.getElementById('signIn').style.display = 'block';
</script>

<?php 

}
?>
    <script>
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            fetch('../Back/api/insert_user.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // alert(data.message);
                    Swal.fire({
                        title: "สมัครสมาชิกสำเร็จ",
                        text: "ยินดีต้อนรับเข้าสู่ระบบ",
                        icon: "success"
                    }).then((resp) => {
                        window.location.reload();
                    })
                    // window.location.href = 'signup_login.php';
                   
                } else {
                    // alert(data.message);
                }
            })
            // .catch(error => console.error('Error:', error));
        });

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            location.href="?page=home";
            var formData = new FormData(this);
            fetch('../Back/api/login_user.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // alert(data.message);
                    
                     Swal.fire({
                        title: "เข้าสู่ระบบสำเร็จ",
                        text: "ยินดีต้อนรับกลับเข้าสู่ระบบ",
                        icon: "success"
                     }).then((resp) => {
                         window.location.reload();
                    
                      })

                // header("Location: ?page=signup;");
                
                
            } else {
                // alert(data.message);
                Swal.fire({
                    title: "ข้อมูลไม่ถูกต้อง",
                    text: "ไม่สามารถเข้าสู่ระบบได้",
                    icon: "error"
                });
                }
            })
            // .catch(error => console.error('Error:', error));
        });

        document.getElementById('signUpButton').addEventListener('click', function() {
            document.getElementById('signup').style.display = 'block';
            document.getElementById('signIn').style.display = 'none';
        });

        document.getElementById('signInButton').addEventListener('click', function() {
            document.getElementById('signup').style.display = 'none';
            document.getElementById('signIn').style.display = 'block';
        });

    </script>
    <script src="js/darkMode.js"></script>
    <!-- <script src="js/signup_login.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>