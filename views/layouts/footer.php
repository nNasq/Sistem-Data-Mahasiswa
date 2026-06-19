<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggleBtn");

        if (sidebar && toggleBtn) {
            const sidebarState = localStorage.getItem("sidebarState");
            
            if (sidebarState === "closed") {
                sidebar.classList.add("hidden");
            }

            toggleBtn.addEventListener("click", function() {
                sidebar.classList.toggle("hidden");
                
                if (sidebar.classList.contains("hidden")) {
                    localStorage.setItem("sidebarState", "closed");
                } else {
                    localStorage.setItem("sidebarState", "open");
                }
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