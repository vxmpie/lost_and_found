const toggleButton = document.getElementById('toggleMode');
const body = document.body;

// เช็คสถานะโหมดเมื่อโหลดหน้า
if (localStorage.getItem('dark-mode') === 'enabled') {
    body.classList.add('dark-mode');
    toggleButton.textContent = "Switch to Light Mode";
}

// เพิ่ม Event Listener สำหรับปุ่ม
toggleButton.addEventListener('click', function() {
    body.classList.toggle('dark-mode');
    
    // บันทึกสถานะโหมด
    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('dark-mode', 'enabled');
        toggleButton.textContent = "Switch to Light Mode";
    } else {
        localStorage.removeItem('dark-mode');
        toggleButton.textContent = "Switch to Dark Mode";
    }
});

function updateDarkModeUI() {
    const isDark = document.body.classList.contains("dark-mode");
    document.querySelectorAll("input, label, button").forEach(el => {
        if (isDark) {
            el.classList.add("dark-mode");
        } else {
            el.classList.remove("dark-mode");
        }
    });
}

function loadTheme() {
    const darkMode = localStorage.getItem("darkMode");
    if (darkMode === "enabled") {
        document.body.classList.add("dark-mode");
        document.getElementById('toggleMode').checked = true;
    }
    updateDarkModeUI();
}

function switchTheme() {
    if (document.getElementById('toggleMode').checked) {
        document.body.classList.add("dark-mode");
        localStorage.setItem("darkMode", "enabled");
    } else {
        document.body.classList.remove("dark-mode");
        localStorage.setItem("darkMode", "disabled");
    }
    updateDarkModeUI();
}

document.getElementById('toggleMode').addEventListener("change", switchTheme);
document.addEventListener("DOMContentLoaded", loadTheme);

