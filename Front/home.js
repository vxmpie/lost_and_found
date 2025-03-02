     // Function to navigate to the post page
     function goToPost(image, title, subtitle, date, location, postedDateTime) {
        const url = `post.html?image=${encodeURIComponent(image)}&title=${encodeURIComponent(title)}&subtitle=${encodeURIComponent(subtitle)}&date=${encodeURIComponent(date)}&location=${encodeURIComponent(location)}&postedDateTime=${encodeURIComponent(postedDateTime)}`;
        window.location.href = url;
    }

    document.addEventListener("DOMContentLoaded", function() {
        const cards = [
            {
                image: "keychain.jpg",
                title: "Keychain",
                description: "This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.",
                date: "วันที่",
                location: "สถานที่",
                postedDateTime: "1 มีนาคม 2025, 14:30",
                loggedIn: true
            },
            {
                image: "myheart.jpg",
                title: "My Heart",
                description: "Waiting for someone",
                date: "วันที่",
                location: "สถานที่",
                postedDateTime: "28 กุมภาพันธ์ 2025, 08:15",
                loggedIn: false
            }
        ];

        // Get search query from the URL
        const searchQuery = new URLSearchParams(window.location.search).get('q') || '';

        // Create card HTML
        function createCard(card) {
            return `
                <div class="card mb-3 mx-auto my-card font" onclick="goToPost('${card.image}', '${card.title}', '${card.description}', '${card.date}', '${card.location}', '${card.postedDateTime}')"
                   >
                    <div class="row g-0">
                        <div class="col-md-4" style="height: 250px; display: flex; align-items: center;">
                            <img src="/image/${card.image}" class="img-fluid rounded-start" alt="${card.title}" 
                                style="height: 100%; width: 100%; object-fit: cover; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column justify-content-between" style="min-height: 200px;">
                                <h2 class="card-title">${card.title}</h2>
                                <p class="card-text flex-grow-1">${card.description}</p>
                                <div>
                                    ${card.loggedIn ? `<h5 class="card-title" style="padding-bottom: 5px;">Test -logged in</h5>` : ""}
                                    <div class="my-textTime my-textfont">
                                        <i class="bi bi-calendar-fill font" style="margin-right: 5px;"></i> ${card.date}
                                    </div>
                                    <div class="my-textTime my-textfont">
                                        <i class="bi bi-geo-alt-fill font" style="margin-right: 5px;"></i> ${card.location}
                                    </div>
                                    <!-- เพิ่มแสดงวันที่และเวลา -->
                                    <div  class="my-textPost">
                                        <i class="bi bi-clock-fill font" style="margin-right: 5px;"></i> โพสต์เมื่อ: ${card.postedDateTime}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Filter cards based on search query
        function filterCards() {
            const filteredCards = cards.filter(card => card.title.toLowerCase().includes(searchQuery.toLowerCase()));
            displayCards(filteredCards);
        }

        // Display filtered cards
        function displayCards(filteredCards) {
            document.getElementById("cardContainer").innerHTML = filteredCards.map(createCard).join("");
        }

        // Run the filter and display the cards
        filterCards();

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
    });

    