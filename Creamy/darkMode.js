const toggleButton = document.getElementById('toggleButton');
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
