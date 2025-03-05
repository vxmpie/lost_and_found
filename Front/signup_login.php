<?php
session_start();
require "db_connect.php";  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="addDesign.css">
    <link rel="stylesheet" href="designset.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="design_login.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" charset="UTF-8"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="design_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Include your custom Calendar -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</head>

<body class="body">
    
    <div class="foundify" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
        <a style="flex-grow: 1; text-align: center;">Foundify</a>

        <label class="switch">
            <input type="checkbox" id="toggleMode">
            <span class="slider"></span>
        </label>
    </div>

    <div class="pageset1" id="page1">
        <div>
            <div class="button_sign" id="signButton">
                <i class="bi bi-person-fill"></i>
                <span> Log In / Sign up</span>
            </div>

        </div>

        <!-- <div class="setting-link" id="gosettingButton">
            <img src="/image/loco_setting.jpg" alt="Settings Icon">
            <span>Setting</span>
        </div> -->
    </div>

    <!-- <div class="wrapper1" id="page2" style="display:none;">
        <span>Setting</span>
        <div class="ThemeButton">
            <label class="switch">
                <input type="checkbox" id="toggleMode">
                <span class="slider"></span>
            </label>
        </div>
        <div class="LanguageButton" onclick="toggleMenu()">
            <span>Language</span>
            <i class="fas fa-angle-right" id="arrow"></i>
            <div class="sub-menu" id="dropdown">
                <label>
                    <input type="radio" name="language" value="English" checked>
                    English (US)
                </label>
                <label>
                    <input type="radio" name="language" value="Thai">
                    Thai
                </label>
            </div>

        </div>
    </div>  -->
    <div class="wrapper" id="signup" style="display:none;">
        <form method="post" action="insert_user.php" onsubmit="showProfile(event, 'signup')">
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

    <div class="wrapper" id="signIn" style="display: none; ">
        <form method="post" action="login_user.php">
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
                <input type="submit" class="btn2" value="Sign In" id="submit_form" name="signIn">
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
                <img id="iconup" src="https://cdn-icons-png.flaticon.com/512/711/711191.png" alt="Camera Icon"
                    width="24" height="24">
            </label>
            <input type="file" id="fileUpload" accept="image/*">
        </div>
        <h1>User Profile</h1>
        <p id="profile-info"></p>
        <span id="userNameDisplay">User</span>
        <button id="changeNameButton" style="border: none; background: none; cursor: pointer;">
            ✏️
        </button>


        <!-- <div class="profile-pic-container">
            <img id="profile-pic" src="/image/loco_set.jpg" alt="Profile Picture">
        </div> -->

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

    <script src="script.js"></script>
    <script src="home.js"></script>
    <script src="darkMode.js"></script>

</body>


</html>