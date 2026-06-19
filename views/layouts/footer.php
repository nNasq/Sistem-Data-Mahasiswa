</div> </div> </div> <script src="assets/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggleBtn");

        if (sidebar && toggleBtn) {
            toggleBtn.addEventListener("click", function() {
                sidebar.classList.toggle("hidden");
            });
        }

        const searchInput = document.getElementById("searchInput");

        if (searchInput) {
            document.addEventListener('keydown', function(e) {
                if (e.key === '/' && document.activeElement !== searchInput && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                    searchInput.focus();
                }
            });

            searchInput.addEventListener("keyup", function() {
                let filter = this.value.toLowerCase();
                let tables = document.querySelectorAll("table tbody"); 
                
                tables.forEach(tbody => {
                    let rows = tbody.querySelectorAll("tr");
                    rows.forEach(row => {
                        let text = row.textContent.toLowerCase();
                        if (text.includes(filter)) {
                            row.style.display = ""; 
                        } else {
                            row.style.display = "none"; 
                        }
                    });
                });
            });
        }
    });
</script>

</body>
</html>