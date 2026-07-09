    </div> <!-- End Main Content -->

    <footer class="text-center py-4 text-muted small border-top bg-white">
        &copy; <?= date('Y') ?> SIM DIKLAT RSUD - Modul Pendidikan. All rights reserved.
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Sidebar Script -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle mobile sidebar toggle
            const toggler = document.querySelector('.navbar-toggler');
            const sidebar = document.getElementById('sidebarMenu');
            if(toggler && sidebar) {
                toggler.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
        });

        // BFCache (Back-Forward Cache) Invalidator
        window.addEventListener('pageshow', function (event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                window.location.reload();
            }
        });
    </script>
</body>
</html>
