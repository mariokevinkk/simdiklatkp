    </div> <!-- End Main Content -->

    <footer class="text-center py-4 text-muted small border-top bg-white footer-admin">
        &copy; <?= date('Y') ?> SIM DIKLAT RSUD - Admin Riset. All rights reserved.
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Sidebar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const sidebar = document.querySelector('.sidebar');
            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
        });
    </script>
</body>
</html>