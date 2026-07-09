<?php

/** @var array $publications */ ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Katalog Penelitian' ?> - SIM DIKLAT RSUD Yogyakarta</title>
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?= base_url('assets/img/logo_rs.jpg') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .bg-dark-header {
            background-color: #1a1a1a;
        }

        .navbar-brand {
            font-size: 18px;
            letter-spacing: 1px;
        }

        .hero-catalog {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px 0;
        }

        .sidebar-filter {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .filter-label {
            font-size: 11px;
            font-weight: 700;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            display: block;
        }

        .repo-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 16px;
            height: 100%;
            cursor: pointer;
            background: white;
            overflow: hidden;
        }

        .repo-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-category {
            font-size: 10px;
            font-weight: 700;
            color: #e53935;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: block;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: #222;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .card-excerpt {
            font-size: 13px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .btn-login-akses {
            border: 1px solid white;
            color: white;
            border-radius: 20px;
            padding: 5px 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-login-akses:hover {
            background: white;
            color: black;
        }

        .active-menu {
            color: #e53935 !important;
            border-bottom: 2px solid #e53935;
            padding-bottom: 5px;
        }

        .search-box {
            background: white;
            border-radius: 30px;
            padding: 5px 5px 5px 25px;
            border: 1px solid #eee;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .search-box input {
            border: none;
            flex: 1;
            outline: none;
            font-size: 14px;
        }

        .search-box .btn-search {
            background: #e53935;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .form-check-input:checked {
            background-color: #e53935;
            border-color: #e53935;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-dark bg-dark-header py-3 px-4">
        <div class="container-fluid d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 gap-md-0">
            <a class="navbar-brand fw-bold" href="<?= base_url('repository/catalog') ?>">
                SIM <span style="color: #e53935;">DIKLAT</span> RSUD Yogyakarta
            </a>
            <div class="d-flex align-items-center gap-4">
                <a href="<?= base_url('/') ?>" class="text-white text-decoration-none fw-bold" style="font-size: 12px; letter-spacing: 1px;">BERANDA</a>
                <a href="<?= base_url('repository/catalog') ?>" class="text-white text-decoration-none fw-bold <?= (uri_string() == 'repository/catalog') ? 'active-menu' : '' ?>" style="font-size: 12px; letter-spacing: 1px;">KATALOG</a>
                <a href="<?= base_url('riset/login') ?>" class="btn btn-login-akses">LOGIN AKSES</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <header class="hero-catalog text-center">
        <div class="container">
            <h1 class="fw-bold mb-2">E-Library & Riset</h1>
            <p class="opacity-75">Katalog Publikasi & Hasil Penelitian Terkini</p>
        </div>
    </header>

    <div class="container my-5">
        <div class="row">
            <!-- Sidebar Filter -->
            <div class="col-lg-3 mb-4">
                <div class="sidebar-filter sticky-top" style="top: 100px;">
                    <span class="filter-label">Cari Penelitian</span>
                    <div class="search-box mb-4">
                        <input type="text" id="searchInput" placeholder="Kata kunci...">
                        <button class="btn-search"><i class="fas fa-search"></i></button>
                    </div>

                    <span class="filter-label">Tahun</span>
                    <div>
                        <select id="yearSelect" class="form-select form-select-sm border-0 bg-light text-muted" style="border-radius: 8px;">
                            <option value="">Pilih Tahun (Semua)</option>
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold text-dark mb-0">Menampilkan hasil untuk: <span class="text-danger" id="searchResultText">"Semua Penelitian"</span></h6>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle text-muted small px-3" type="button" data-bs-toggle="dropdown" id="sortDropdownBtn">
                            Urutkan: A-Z
                        </button>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item small sort-opt" href="#" data-sort="asc">A-Z</a></li>
                            <li><a class="dropdown-item small sort-opt" href="#" data-sort="desc">Z-A</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row g-4" id="repoContainer">
                    <?php foreach ($publications as $pub): 
                        $tahunPenelitian = !empty($pub['waktu_selesai']) ? date('Y', strtotime($pub['waktu_selesai'])) : date('Y', strtotime($pub['created_at']));
                    ?>
                        <div class="col-md-6 col-xl-4 repo-item" data-title="<?= esc(strtolower($pub['judul'])) ?>" data-year="<?= $tahunPenelitian ?>">
                            <div class="card repo-card p-4 shadow-sm" onclick="window.location='<?= base_url('repository/detail/' . $pub['id']) ?>'">
                                <span class="card-category"><?= esc($pub['kategori_jurnal'] ?? 'Karya Ilmiah') ?></span>
                                <h3 class="card-title"><?= esc($pub['judul']) ?></h3>
                                <p class="card-excerpt"><?= esc(mb_strimwidth($pub['abstrak'], 0, 120, '...')) ?></p>
                                <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                                    <div class="d-flex align-items-center text-muted col-8">
                                        <i class="fas fa-user-circle me-2"></i>
                                        <span class="small text-truncate"><?= esc($pub['nama']) ?></span>
                                    </div>
                                    <span class="badge bg-light text-muted fw-normal" style="font-size: 10px;"><?= $tahunPenelitian ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <nav class="mt-5">
                    <ul class="pagination justify-content-center" id="paginationContainer">
                        <!-- Pagination populated by JS -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white py-5 mt-5">
        <div class="container text-center">
            <h6 class="fw-bold text-dark mb-2" style="font-size: 14px;">RSUD Kota Yogyakarta</h6>
            <p class="text-muted small mb-0">© 2026 RSUD Kota Yogyakarta. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const yearSelect = document.getElementById('yearSelect');
            const sortOpts = document.querySelectorAll('.sort-opt');
            const sortDropdownBtn = document.getElementById('sortDropdownBtn');
            const searchResultText = document.getElementById('searchResultText');
            const container = document.getElementById('repoContainer');
            const paginationContainer = document.getElementById('paginationContainer');

            // Store original DOM elements
            let allItems = Array.from(container.querySelectorAll('.repo-item'));

            // State
            let currentSearch = '';
            let currentYear = '';
            let currentSort = 'asc'; // 'asc' or 'desc'
            let currentPage = 1;
            const itemsPerPage = 6;

            function render() {
                // 1. Filter
                let filtered = allItems.filter(item => {
                    const title = item.getAttribute('data-title') || '';
                    const year = item.getAttribute('data-year') || '';

                    const matchSearch = title.includes(currentSearch);
                    const matchYear = currentYear === '' || year === currentYear;

                    return matchSearch && matchYear;
                });

                // 2. Sort
                filtered.sort((a, b) => {
                    const titleA = a.getAttribute('data-title');
                    const titleB = b.getAttribute('data-title');
                    if (currentSort === 'asc') return titleA.localeCompare(titleB);
                    if (currentSort === 'desc') return titleB.localeCompare(titleA);
                    return 0;
                });

                // Update result text
                if (currentSearch === '') {
                    searchResultText.textContent = '"Semua Penelitian"';
                } else {
                    searchResultText.textContent = '"' + currentSearch + '"';
                }

                // 3. Paginate
                const totalPages = Math.ceil(filtered.length / itemsPerPage);
                if (currentPage > totalPages) currentPage = totalPages || 1;

                const startIndex = (currentPage - 1) * itemsPerPage;
                const pagedItems = filtered.slice(startIndex, startIndex + itemsPerPage);

                // Clear container and append visible items
                container.innerHTML = '';
                if (pagedItems.length === 0) {
                    container.innerHTML = '<div class="col-12 text-center py-5 text-muted">Tidak ada penelitian yang sesuai dengan kriteria pencarian.</div>';
                } else {
                    pagedItems.forEach(item => container.appendChild(item));
                }

                // 4. Render Pagination Controls
                renderPagination(totalPages);
            }

            function renderPagination(totalPages) {
                paginationContainer.innerHTML = '';

                if (totalPages <= 1) return; // No need for pagination if only 1 page

                // Prev Button
                const prevLi = document.createElement('li');
                prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
                prevLi.innerHTML = `<a class="page-link border-0 bg-light me-2 rounded-circle text-muted" href="#" data-page="${currentPage - 1}"><i class="fas fa-chevron-left"></i></a>`;
                paginationContainer.appendChild(prevLi);

                // Page Numbers
                for (let i = 1; i <= totalPages; i++) {
                    const li = document.createElement('li');
                    li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                    if (i === currentPage) {
                        li.innerHTML = `<a class="page-link border-0 rounded-circle me-2" style="background: #e53935; color: white;" href="#" data-page="${i}">${i}</a>`;
                    } else {
                        li.innerHTML = `<a class="page-link border-0 bg-light me-2 rounded-circle text-muted" href="#" data-page="${i}">${i}</a>`;
                    }
                    paginationContainer.appendChild(li);
                }

                // Next Button
                const nextLi = document.createElement('li');
                nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
                nextLi.innerHTML = `<a class="page-link border-0 bg-light rounded-circle text-muted" href="#" data-page="${currentPage + 1}"><i class="fas fa-chevron-right"></i></a>`;
                paginationContainer.appendChild(nextLi);

                // Attach events
                const pageLinks = paginationContainer.querySelectorAll('a.page-link');
                pageLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const newPage = parseInt(this.getAttribute('data-page'));
                        if (!isNaN(newPage) && newPage >= 1 && newPage <= totalPages) {
                            currentPage = newPage;
                            render();
                            window.scrollTo({
                                top: 200,
                                behavior: 'smooth'
                            });
                        }
                    });
                });
            }

            // Event Listeners
            searchInput.addEventListener('keyup', function() {
                currentSearch = this.value.toLowerCase();
                currentPage = 1; // Reset to page 1 on search
                render();
            });

            yearSelect.addEventListener('change', function() {
                currentYear = this.value;
                currentPage = 1;
                render();
            });

            sortOpts.forEach(opt => {
                opt.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentSort = this.getAttribute('data-sort');
                    sortDropdownBtn.innerHTML = `Urutkan: ${currentSort === 'asc' ? 'A-Z' : 'Z-A'}`;
                    currentPage = 1;
                    render();
                });
            });

            // Initial Render
            render();
        });
    </script>
</body>

</html>