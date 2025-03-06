<div class="container d-flex flex-column align-items-center justify-content-center was-validated" style="height: 100vh; padding-top: 20px;">=
    <form class="search-contrainer w-100 mt-5" role="search"  onsubmit="performSearch(event)">
        <div class="input-group" style="width: 100%; display: flex; align-items: center;">
            <input class="form-control rounded-pill search" type="search" placeholder="Search" aria-label="Search" id="searchInput">
            <button class="btn btn-outline-success rounded-pill" type="submit" style="border: none; background: none; margin-left: 10px;  color: rgb(36,222,206);"
                onmouseover="this.style.backgroundColor='#dcdcdc';" onmouseout="this.style.backgroundColor='';">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>


    <div class="container" style="padding-top: 20px; padding-bottom: 80px;">
        <div id="searchResults"></div>
    </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const query = new URLSearchParams(window.location.search).get('q');
            if (query) {
                performSearch(null, query);
            }
        });

        function performSearch(event, query) {
            if (event) {
                event.preventDefault();
                query = document.getElementById('searchInput').value;
            }
            fetch(`../Back/api/search.php?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    const searchResults = document.getElementById('searchResults');
                    searchResults.innerHTML = '';
                    if (data.status === 'success') {
                        data.results.forEach(item => {
                            const itemCard = `
                                <div class="card mb-3 mx-auto my-card font">
                                    <div class="row g-0">
                                        <div class="col-md-4" style="height: 250px; display: flex; align-items: center;">
                                            <img src="../back/api/uploads/${item.image}" class="img-fluid rounded-start" style="height: 100%; width: 100%; object-fit: cover; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body d-flex flex-column justify-content-between" style="min-height: 200px;">
                                                <h2 class="card-title">${item.name}</h2>
                                                <p class="card-text flex-grow-1">${item.description}</p>
                                                <div>
                                                    <div class="my-textTime my-textfont">
                                                        <i class="bi bi-calendar-fill font" style="margin-right: 5px;"></i> ${item.date}
                                                    </div>
                                                    <div class="my-textTime my-textfont">
                                                        <i class="bi bi-geo-alt-fill font" style="margin-right: 5px;"></i> ${item.location}
                                                    </div>
                                                    <div class="my-textPost">
                                                        <i class="bi bi-clock-fill font" style="margin-right: 5px;"></i> โพสต์เมื่อ: ${item.created_at}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            searchResults.innerHTML += itemCard;
                        });
                    } else {
                        searchResults.innerHTML = `<p>${data.message}</p>`;
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Footer active link script
    </script>
    <script src="js/darkMode.js"></script>