    <?php 
    session_start();
    
    ?>
    <div class="container mx-auto">
        <div id="postContent" style="margin-top: 150%">
            <!-- Content will be loaded here by JavaScript -->
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const postId = new URLSearchParams(window.location.search).get('id');
            fetch(`../Back/api/get_post.php?id=${postId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const post = data.post;
                        const user = data.user;
                        const postContent = `
                            <img src="../back/api/uploads/${post.image}" class="img-fluid rounded" style="transparent: 50%; margin-top: 10%">
                            <div class="card-body">
                                <h2 class="card-title">${post.name}</h2>
                                <p class="card-text">${post.description}</p>
                                <div class="font">
                                    <i class="bi bi-calendar-fill" style="margin-right: 5px; color: rgba(5, 223, 209, 0.829)"></i>
                                    <span>${post.date}</span>
                                </div>
                                <div class="font">
                                    <i class="bi bi-geo-alt-fill" style="margin-right: 5px;color: rgba(5, 223, 209, 0.829)"></i>
                                    <span>${post.location}</span>
                                </div>
                                <div class="my-textPost">
                                    <i class="bi bi-clock-fill" style="margin-right: 5px;"></i> โพสต์เมื่อ: ${post.created_at}
                                </div>
                                <div id="app" style="padding-top: 20px; margin-bottom: 30px;">
                                    <button id="contactButton">Contact</button>
                                    <div id="contactBox" class="contact-box">
                                        <button class="hide-button" onclick="toggleContact()">Hide</button>
                                        <div style="font-size: 20px;"><strong>Contact</strong></div>
                                        <div>Email: ${user.email}</div>
                                    </div>
                                    <div class="backdrop" id="backdrop"></div>
                                    <div class="dialog background" id="dialog">
                                        <h2>Please Log in</h2>
                                        <p>to view contact information.</p>
                                        <button onclick="goToLogin()">Go to Account for Log In</button>
                                    </div>
                                </div>
                            </div>`;
                        document.getElementById('postContent').innerHTML = postContent;
                        setupContactButton(data.isLoggedIn);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        function toggleContact() {
            const contactBox = document.getElementById('contactBox');
            const contactButton = document.getElementById('contactButton');
            contactBox.classList.toggle('active');
            contactButton.style.display = contactBox.classList.contains('active') ? 'none' : 'inline-block';
        }

        function showDialog() {
            const dialog = document.getElementById('dialog');
            const backdrop = document.getElementById('backdrop');
            dialog.classList.add('active');
            backdrop.classList.add('active');
        }

        function hideDialog() {
            const dialog = document.getElementById('dialog');
            const backdrop = document.getElementById('backdrop');
            dialog.classList.remove('active');
            backdrop.classList.remove('active');
        }

        function goToLogin() {
            window.location.href = 'signup_login.html';
            hideDialog();
        }

        function setupContactButton(isLoggedIn) {
            const contactButton = document.getElementById('contactButton');
            contactButton.onclick = isLoggedIn ? toggleContact : showDialog;
            if (!isLoggedIn) {
                contactButton.textContent = 'Request Founder Contact';
            }
        }
        
        // Footer active link script

    </script>

    <script src="js/darkMode.js"></script>