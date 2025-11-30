<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Edukasi Pertanian - AgriEl</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .article-card {
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        .article-card:hover {
            background: #e9ecef;
        }
        .category-badge {
            font-size: 0.8rem;
            padding: 4px 12px;
        }
        .read-time {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .search-box {
            border-radius: 25px;
            border: 2px solid #28a745;
            padding: 12px 20px;
        }
        .category-filter {
            background: none;
            border: 1px solid #dee2e6;
            border-radius: 20px;
            padding: 8px 16px;
            margin: 5px;
        }
        .category-filter.active {
            background: #28a745;
            color: white;
            border-color: #28a745;
        }
    </style>
</head>
<body>
    <!-- Simple Header -->
    <div class="container-fluid bg-success text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h3 mb-1">
                        <i class="fas fa-graduation-cap me-2"></i>Pusat Edukasi Pertanian
                    </h1>
                    <p class="mb-0">Tingkatkan pengetahuan dan keterampilan bertani dengan artikel-artikel berkualitas dari ahli pertanian terpercaya.</p>
                </div>
                <div class="col-auto">
                    <a href="index.php" class="btn btn-light btn-sm">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <!-- Search Box -->
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Cari artikel...</h6>
                    <div class="input-group">
                        <input type="text" class="form-control search-box" placeholder="Ketik judul artikel...">
                        <button class="btn btn-success" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Categories -->
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Semua Kategori</h6>
                    <div class="d-flex flex-wrap">
                        <button class="category-filter active">Organik</button>
                        <button class="category-filter">Teknologi</button>
                        <button class="category-filter">Pemupukan</button>
                        <button class="category-filter">Irigasi</button>
                        <button class="category-filter">Pemasaran</button>
                        <button class="category-filter">Hama</button>
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Tags Populer</h6>
                    <div class="d-flex flex-wrap">
                        <span class="badge bg-light text-dark me-1 mb-1">Padi</span>
                        <span class="badge bg-light text-dark me-1 mb-1">Organik</span>
                        <span class="badge bg-light text-dark me-1 mb-1">Hama</span>
                        <span class="badge bg-light text-dark me-1 mb-1">Pupuk</span>
                        <span class="badge bg-light text-dark me-1 mb-1">Irigasi</span>
                        <span class="badge bg-light text-dark me-1 mb-1">Panen</span>
                    </div>
                </div>
            </div>

            <!-- Articles List -->
            <div class="col-md-9">
                <!-- Featured Article -->
                <div class="card article-card mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <span class="badge bg-success category-badge mb-2">Organik</span>
                                <h4 class="card-title mb-3">Cara Bertani Padi Organik</h4>
                                <p class="card-text text-muted mb-3">
                                    Panduan lengkap bertani padi dengan metode organik untuk hasil yang lebih sehat dan ramah lingkungan. Pelajari teknik dari persiapan lahan hingga panen.
                                </p>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <strong>Dr. Ahmad Wijaya</strong>
                                        <div class="text-muted small">Ahli Pertanian Organik</div>
                                    </div>
                                    <div class="read-time">
                                        <i class="fas fa-clock me-1"></i>5 min read
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <a href="article-detail.php?id=1" class="btn btn-success">
                                    <i class="fas fa-book-open me-2"></i>Baca
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article List -->
                <div class="row">
                    <!-- Article 1 -->
                    <div class="col-12 mb-3">
                        <div class="card article-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <span class="badge bg-warning category-badge mb-2">Hama</span>
                                        <h5 class="card-title mb-2">Pengendalian Hama Terpadu</h5>
                                        <p class="card-text text-muted mb-2 small">
                                            Teknik efektif mengendalikan hama tanpa merusak lingkungan dan ekosistem pertanian.
                                        </p>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <strong>Prof. Siti Rahayu</strong>
                                            </div>
                                            <div class="read-time small">
                                                <i class="fas fa-clock me-1"></i>7 min read
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <a href="article-detail.php?id=2" class="btn btn-outline-success btn-sm">
                                            Baca
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Article 2 -->
                    <div class="col-12 mb-3">
                        <div class="card article-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <span class="badge bg-info category-badge mb-2">Teknologi</span>
                                        <h5 class="card-title mb-2">IoT dalam Pertanian Modern</h5>
                                        <p class="card-text text-muted mb-2 small">
                                            Pemanfaatan Internet of Things untuk memantau dan mengoptimalkan hasil pertanian.
                                        </p>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <strong>Ir. Bambang Tech</strong>
                                            </div>
                                            <div class="read-time small">
                                                <i class="fas fa-clock me-1"></i>8 min read
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <a href="article-detail.php?id=3" class="btn btn-outline-success btn-sm">
                                            Baca
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Article 3 -->
                    <div class="col-12 mb-3">
                        <div class="card article-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <span class="badge bg-primary category-badge mb-2">Pemupukan</span>
                                        <h5 class="card-title mb-2">Teknik Pemupukan yang Efektif</h5>
                                        <p class="card-text text-muted mb-2 small">
                                            Cara tepat memberikan pupuk untuk tanaman dengan dosis dan waktu yang optimal.
                                        </p>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <strong>Dr. Maria Fertiliana</strong>
                                            </div>
                                            <div class="read-time small">
                                                <i class="fas fa-clock me-1"></i>6 min read
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <a href="article-detail.php?id=4" class="btn btn-outline-success btn-sm">
                                            Baca
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Article 4 -->
                    <div class="col-12 mb-3">
                        <div class="card article-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <span class="badge bg-success category-badge mb-2">Irigasi</span>
                                        <h5 class="card-title mb-2">Sistem Irigasi Modern</h5>
                                        <p class="card-text text-muted mb-2 small">
                                            Mengenal berbagai sistem irigasi yang efisien untuk menghemat air dan meningkatkan hasil.
                                        </p>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <strong>Ir. Joko Waterman</strong>
                                            </div>
                                            <div class="read-time small">
                                                <i class="fas fa-clock me-1"></i>9 min read
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <a href="article-detail.php?id=5" class="btn btn-outline-success btn-sm">
                                            Baca
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Article 5 -->
                    <div class="col-12 mb-3">
                        <div class="card article-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <span class="badge bg-warning category-badge mb-2">Pemasaran</span>
                                        <h5 class="card-title mb-2">Strategi Pemasaran Hasil Panen</h5>
                                        <p class="card-text text-muted mb-2 small">
                                            Tips dan trik memasarkan hasil pertanian dengan harga yang menguntungkan.
                                        </p>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <strong>Dian Marketing</strong>
                                            </div>
                                            <div class="read-time small">
                                                <i class="fas fa-clock me-1"></i>10 min read
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <a href="article-detail.php?id=6" class="btn btn-outline-success btn-sm">
                                            Baca
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Load More -->
                <div class="text-center mt-4">
                    <button class="btn btn-outline-success">
                        <i class="fas fa-refresh me-2"></i>Muat Lebih Banyak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Footer -->
    <footer class="bg-light border-top mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="mb-2">
                        <i class="fas fa-seedling me-2 text-success"></i>AgriEl
                    </h6>
                    <p class="text-muted small mb-0">Platform edukasi dan pasar digital untuk petani Indonesia.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted small mb-0">&copy; 2025 AgriEl. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.category-filter').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.category-filter').forEach(btn => {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        document.querySelector('.search-box').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.article-card').forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const description = card.querySelector('.card-text').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>