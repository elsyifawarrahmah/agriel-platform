<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AgriEl - Platform Edukasi & Pasar Digital Petani</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Core theme CSS -->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/auth.css" rel="stylesheet" />
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-seedling me-2"></i>AgriEl
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="marketplace.php">Pasar Digital</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="articles.php">Edukasi</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="consultation.php">Konsultasi</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.php">Kontak</a></li>
                    <li class="nav-item">
    <a class="nav-link px-lg-3 py-3 py-lg-4" href="cart.php">
        <i class="fas fa-shopping-cart me-1"></i>Keranjang
        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <span class="badge bg-danger rounded-pill" id="cart-badge"><?php echo count($_SESSION['cart']); ?></span>
        <?php endif; ?>
    </a>
</li>
                    
                    <?php if(isset($_SESSION['user'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>
                            <?php echo htmlspecialchars($_SESSION['user']['nama']); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="backend/auth/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>Akun
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#registerModal"><i class="fas fa-user-plus me-2"></i>Daftar</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading text-white">
                        <h1>AgriEl</h1>
                        <span class="subheading">Platform Edukasi & Pasar Digital untuk Petani Lokal</span>
                        <div class="mt-4">
                            <a href="marketplace.php" class="btn btn-primary btn-lg me-2">
                                <i class="fas fa-shopping-cart me-2"></i>Belanja Produk
                            </a>
                            <a href="articles.php" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-book me-2"></i>Baca Artikel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Produk Unggulan Section -->
                <div class="post-preview">
                    <h2 class="post-title">Produk Unggulan</h2>
                    <div class="row mt-4" id="featuredProducts">
                        <div class="col-12 text-center">
                            <div class="spinner-border text-success" role="status">
                                <span class="visually-hidden">Memuat produk...</span>
                            </div>
                            <p class="mt-2">Memuat produk...</p>
                        </div>
                    </div>
                </div>
                
                <hr class="my-4" />
                
                <!-- Artikel Terbaru Section -->
                <div class="post-preview">
                    <h2 class="post-title">Artikel Terbaru</h2>
                    <div class="row mt-4" id="latestArticles">
                        <div class="col-12 text-center">
                            <div class="spinner-border text-success" role="status">
                                <span class="visually-hidden">Memuat artikel...</span>
                            </div>
                            <p class="mt-2">Memuat artikel...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login ke AgriEl</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" action="backend/auth/login.php" method="POST">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Daftar di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Akun Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm" action="backend/auth/register.php" method="POST">
                        <div class="mb-3">
                            <label for="regName" class="form-label">Nama Lengkap *</label>
                            <input type="text" class="form-control" id="regName" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="regEmail" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="regEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="regPassword" class="form-label">Password *</label>
                            <input type="password" class="form-control" id="regPassword" name="password" required minlength="6">
                        </div>
                        <div class="mb-3">
                            <label for="regPhone" class="form-label">Nomor HP</label>
                            <input type="tel" class="form-control" id="regPhone" name="no_hp" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="mb-3">
                            <label for="regAddress" class="form-label">Alamat</label>
                            <textarea class="form-control" id="regAddress" name="alamat" rows="2" placeholder="Alamat lengkap"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="regRole" class="form-label">Daftar sebagai *</label>
                            <select class="form-select" id="regRole" name="role" required>
                                <option value="">Pilih peran...</option>
                                <option value="petani">Petani</option>
                                <option value="pembeli">Pembeli</option>
                                <option value="expert">Ahli Pertanian</option>
                            </select>
                        </div>
                        <div class="mb-3" id="fieldSection" style="display: none;">
                            <label for="regField" class="form-label">Bidang Pertanian</label>
                            <input type="text" class="form-control" id="regField" name="bidang" placeholder="Contoh: Padi, Sayuran, dll">
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-user-plus me-2"></i>Daftar
                        </button>
                    </form>
                    <div class="mt-3 text-center">
                        <small class="text-muted">* Wajib diisi</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="border-top mt-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="small text-center text-muted fst-italic">
                        <i class="fas fa-seedling me-1"></i> AgriEl 2025 - Platform untuk Petani Indonesia
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Memuat data AgriEl...');
    
    fetch('backend/api/products.php?limit=3')
        .then(response => {
            console.log('Status response produk:', response.status);
            if (!response.ok) {
                throw new Error('Error jaringan: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Data produk:', data);
            const container = document.getElementById('featuredProducts');
            
            if(data.success && data.data && data.data.length > 0) {
                container.innerHTML = data.data.map(product => `
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100 shadow-sm">
                            <img src="${product.gambar}" 
                                 class="card-img-top" 
                                 alt="${product.nama_produk}" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-success">${product.nama_produk}</h5>
                                <p class="card-text flex-grow-1 text-muted">
                                    ${product.deskripsi.substring(0, 80)}...
                                </p>
                                <div class="mt-auto">
                                    <p class="card-text price-tag text-success fw-bold fs-5">
                                        Rp ${parseInt(product.harga).toLocaleString()}
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="fas fa-user me-1"></i>${product.farmer_name}
                                        </small>
                                    </p>
                                    <a href="marketplace.php" class="btn btn-success w-100">
                                        <i class="fas fa-shopping-cart me-2"></i>Beli Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('');
            } else {
                container.innerHTML = `
                    <div class="col-12 text-center py-4">
                        <i class="fas fa-seedling fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada produk tersedia.</p>
                        <a href="marketplace.php" class="btn btn-primary">Jelajahi Pasar Digital</a>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading products:', error);
            document.getElementById('featuredProducts').innerHTML = `
                <div class="col-12 text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                    <p>Gagal memuat produk. Silakan refresh halaman.</p>
                    <button onclick="window.location.reload()" class="btn btn-outline-primary">
                        <i class="fas fa-redo me-2"></i>Refresh Halaman
                    </button>
                </div>
            `;
        });

    fetch('backend/api/articles.php?limit=3')
        .then(response => {
            console.log('Status response artikel:', response.status);
            if (!response.ok) {
                throw new Error('Error jaringan: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Data artikel:', data);
            const container = document.getElementById('latestArticles');
            
            if(data.success && data.data && data.data.length > 0) {
                container.innerHTML = data.data.map(article => `
                    <div class="col-md-4 mb-4">
                        <div class="card article-card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-success">${article.kategori}</span>
                                    <small class="text-muted">${article.tanggal}</small>
                                </div>
                                <h5 class="card-title">${article.judul}</h5>
                                <p class="card-text flex-grow-1 text-muted">
                                    ${article.isi.substring(0, 100)}...
                                </p>
                                <div class="mt-auto">
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>Oleh: ${article.expert_name}
                                    </small>
                                    <a href="articles.php" class="btn btn-outline-success btn-sm w-100 mt-2">
                                        <i class="fas fa-book me-2"></i>Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('');
            } else {
                container.innerHTML = `
                    <div class="col-12 text-center py-4">
                        <i class="fas fa-book fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada artikel tersedia.</p>
                        <a href="articles.php" class="btn btn-primary">Jelajahi Artikel</a>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading articles:', error);
            document.getElementById('latestArticles').innerHTML = `
                <div class="col-12 text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                    <p>Gagal memuat artikel. Silakan refresh halaman.</p>
                    <button onclick="window.location.reload()" class="btn btn-outline-primary">
                        <i class="fas fa-redo me-2"></i>Refresh Halaman
                    </button>
                </div>
            `;
        });
});

document.getElementById('regRole').addEventListener('change', function() {
    const fieldSection = document.getElementById('fieldSection');
    fieldSection.style.display = (this.value === 'petani' || this.value === 'expert') ? 'block' : 'none';
});
</script>
</body>
</html>