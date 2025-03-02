
        // Footer active link script
        const currentPage = window.location.pathname.split("/").pop(); // ตรวจสอบชื่อไฟล์หน้าเว็บปัจจุบัน
        const links = document.querySelectorAll('.footer-icon'); // เลือกไอคอนทั้งหมดใน footer

        links.forEach(link => {
            link.classList.remove('active'); // ลบคลาส active ออกจากไอคอนทั้งหมด
        });

        // เปลี่ยนคลาส active สำหรับไอคอนที่ตรงกับหน้าเว็บที่เปิด
        if (currentPage === 'home.html') {
            document.getElementById('homeLink').classList.add('active');
        } else if (currentPage === 'search.html') {
            document.getElementById('searchLink').classList.add('active');
        } else if (currentPage === 'add.html') {
            document.getElementById('addLink').classList.add('active');
        } else if (currentPage === 'signup_login.html') {
            document.getElementById('setLink').classList.add('active');
        }
    
