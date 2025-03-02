const settingpage = document.getElementById('gosettingButton');
const page1Form = document.getElementById('page1');
const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');
const signButton = document.getElementById('signButton');

signButton.addEventListener('click', function () {
    page1Form.style.display = "none";
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
    pageprofile.style.display = "none";
})

signUpButton.addEventListener('click', function () {
    page1Form.style.display = "none";
    signInForm.style.display = "none";
    signUpForm.style.display = "block";
    pageprofile.style.display = "none";
})
signInButton.addEventListener('click', function () {
    page1Form.style.display = "none";
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
    pageprofile.style.display = "none";
})

// function toggleMenu() {
//     const menu = document.getElementById("dropdown");
//     const arrow = document.getElementById("arrow");
//     const isVisible = menu.style.display === "block";
//     menu.style.display = isVisible ? "none" : "block";
//     arrow.style.transform = isVisible ? "rotate(0deg)" : "rotate(90deg)";
// }
function showProfile(event, formType) {
    event.preventDefault();
    let name = "", email = "";

    if (formType === 'signup') {
        name = document.getElementById('signup-Name').value;
        email = document.getElementById('signup-email').value;
        document.getElementById('userNameDisplay').textContent = document.getElementById('signup-Username').value;
    } else {
        email = document.getElementById('signin-email').value;
        name = "User";
        document.getElementById('userNameDisplay').textContent = name;
    }

    document.getElementById('profile-info').innerHTML = `Name: ${name}<br>Email: ${email}`;
    document.getElementById('signup').style.display = 'none';
    document.getElementById('signIn').style.display = 'none';
    document.getElementById('profilepage').style.display = 'block';
    setupToggleListeners();
    // โหลดชื่อจาก Local Storage
// document.addEventListener("DOMContentLoaded", function () {

//         document.getElementById('userNameDisplay').textContent = name;
    
// });
}
// const toggleSwitch = document.getElementById('toggleMode');

// // โหลดค่าธีมจาก Local Storage
// function updateDarkModeUI() {
//     const isDark = document.body.classList.contains("dark-mode");
//     document.querySelectorAll("input, label, button").forEach(el => {
//         if (isDark) {
//             el.classList.add("dark-mode");
//         } else {
//             el.classList.remove("dark-mode");
//         }
//     });
// }

// function loadTheme() {
//     const darkMode = localStorage.getItem("darkMode");
//     if (darkMode === "enabled") {
//         document.body.classList.add("dark-mode");
//         document.getElementById('toggleMode').checked = true;
//     }
//     updateDarkModeUI();
// }

// function switchTheme() {
//     if (document.getElementById('toggleMode').checked) {
//         document.body.classList.add("dark-mode");
//         localStorage.setItem("darkMode", "enabled");
//     } else {
//         document.body.classList.remove("dark-mode");
//         localStorage.setItem("darkMode", "disabled");
//     }
//     updateDarkModeUI();
// }

// document.getElementById('toggleMode').addEventListener("change", switchTheme);
// document.addEventListener("DOMContentLoaded", loadTheme);



document.getElementById('fileUpload').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('profileImage').src = reader.result;
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById('changeNameButton').addEventListener('click', function () {
    let nameDisplay = document.getElementById('userNameDisplay');
    
    // สร้าง input element
    let input = document.createElement('input');
    input.type = "text";
    input.value = nameDisplay.textContent;
    input.id = "editUserName";
    input.style.fontSize = "inherit";
    input.style.border = "1px solid #ccc";
    input.style.padding = "2px 5px";
    input.style.width = "auto";

    // แทนที่ <span> ด้วย <input>
    nameDisplay.replaceWith(input);
    input.focus();

    // เมื่อกด Enter หรือคลิกออกนอกช่อง input
    input.addEventListener("blur", saveName);
    input.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            saveName();
        }
    });

    function saveName() {
        let newName = input.value.trim() ; //

        // สร้าง <span> ใหม่แทนที่ <input>
        let newSpan = document.createElement('span');
        newSpan.id = "userNameDisplay";
        newSpan.textContent = newName;

        input.replaceWith(newSpan);
    }
});

// โหลดค่าจาก Local Storage เมื่อเปิดหน้า
// document.addEventListener("DOMContentLoaded", function () {
//     let savedName = localStorage.getItem('userName') || "User";
//     document.getElementById('userNameDisplay').textContent = savedName;
// });



