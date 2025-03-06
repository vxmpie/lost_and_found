<div class="container">
    <form action="../Back/api/add.php" method="POST" enctype="multipart/form-data" id="yourFormId" class="w-full align-items-center justify-content-center was-validated" style="padding-top: 20px; margin-top: 50%;">
            <div class="mb-3" style="padding-top: 10px;">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control formSearch" name="name" id="name" placeholder="Enter name" required>
                <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="mb-3" style="padding-top: 10px;">
                <label for="fileToUpload" class="form-label">Image</label>
                <input type="file" class="form-control formSearch" name="fileToUpload" id="fileToUpload" required>
            </div>
            <div class="mb-3" style="padding-top: 10px;">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control formSearch" name="description" id="description" placeholder="Enter description" required>
            </div>
            <div class="mb-3" style="padding-top: 10px;">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control formSearch" name="date" id="date" required>
            </div>
            <div class="mb-3" style="padding-top: 10px;">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control formSearch" name="location" id="location" placeholder="Enter location" required>
            </div>
            <div class="mb-3" style="padding-top: 10px; margin-bottom: 25px;">
                <div id="app">
                    <button type="submit" id="postButton" style="border-radius: 10px; padding: 10px; width: 30%;">Post</button>
                </div>
            </div>
        </form>
    </div>
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
                        <a href="index.html" class="transparent-btn">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/darkMode.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>