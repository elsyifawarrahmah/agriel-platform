<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pasar Digital - AgriEl</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .product-card { 
            transition: all 0.3s ease; 
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .product-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 5px 20px rgba(0,0,0,0.15); 
        }
        .price-tag { 
            color: #28a745; 
            font-weight: bold; 
            font-size: 1.2em;
        }
        .alert-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
        }
    </style>
</head>
<body>
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
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 active" href="marketplace.php">Pasar Digital</a></li>
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

    <header class="masthead" style="background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading text-white text-center">
                        <h1><i class="fas fa-shopping-basket me-3"></i>Pasar Digital AgriEl</h1>
                        <span class="subheading">Beli produk pertanian segar langsung dari petani</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-12">
                <h3>Semua Produk Tersedia</h3>
                <div class="row" id="productsGrid">
                    <!-- Produk 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100">
                            <img src="https://via.placeholder.com/300x200/4CAF50/FFFFFF?text=Beras+Organik" class="card-img-top" alt="Beras Organik" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Beras Organik Premium</h5>
                                <p class="card-text">Beras organik kualitas premium, bebas pestisida dan bahan kimia.</p>
                                <div class="mt-auto">
                                    <p class="price-tag">Rp 25.000/kg</p>
                                    <p class="text-muted small">Stok: 100 kg</p>
                                    <p class="text-muted small">Penjual: Petani Budi</p>
                                    <?php if(isset($_SESSION['user'])): ?>
                                        <button class="btn btn-success w-100" 
                                            onclick="addToCart(
                                                1, 
                                                'Beras Organik Premium', 
                                                25000, 
                                                'https://via.placeholder.com/300x200/4CAF50/FFFFFF?text=Beras+Organik'
                                            )">
                                            <i class="fas fa-cart-plus me-2"></i>Beli Sekarang
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            <i class="fas fa-cart-plus me-2"></i>Login untuk Beli
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produk 2 -->
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100">
                            <img src="https://via.placeholder.com/300x200/FF9800/FFFFFF?text=Cabe+Rawit" class="card-img-top" alt="Cabe Rawit" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Cabe Rawit Merah</h5>
                                <p class="card-text">Cabe rawit segar langsung dari kebun, pedas dan berkualitas.</p>
                                <div class="mt-auto">
                                    <p class="price-tag">Rp 35.000/kg</p>
                                    <p class="text-muted small">Stok: 50 kg</p>
                                    <p class="text-muted small">Penjual: Petani Sari</p>
                                    <?php if(isset($_SESSION['user'])): ?>
                                        <button class="btn btn-success w-100" 
                                            onclick="addToCart(
                                                2, 
                                                'Cabe Rawit Merah', 
                                                35000, 
                                                'https://via.placeholder.com/300x200/FF9800/FFFFFF?text=Cabe+Rawit'
                                            )">
                                            <i class="fas fa-cart-plus me-2"></i>Beli Sekarang
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            <i class="fas fa-cart-plus me-2"></i>Login untuk Beli
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produk 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100">
                            <img src="https://via.placeholder.com/300x200/8BC34A/FFFFFF?text=Jagung+Manis" class="card-img-top" alt="Jagung Manis" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Jagung Manis Segar</h5>
                                <p class="card-text">Jagung manis hasil panen terbaru, manis dan segar.</p>
                                <div class="mt-auto">
                                    <p class="price-tag">Rp 15.000/kg</p>
                                    <p class="text-muted small">Stok: 80 kg</p>
                                    <p class="text-muted small">Penjual: Petani Deni</p>
                                    <?php if(isset($_SESSION['user'])): ?>
                                        <button class="btn btn-success w-100" 
                                            onclick="addToCart(
                                                3, 
                                                'Jagung Manis Segar', 
                                                15000, 
                                                'https://via.placeholder.com/300x200/8BC34A/FFFFFF?text=Jagung+Manis'
                                            )">
                                            <i class="fas fa-cart-plus me-2"></i>Beli Sekarang
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            <i class="fas fa-cart-plus me-2"></i>Login untuk Beli
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle bidang pertanian field
        document.getElementById('regRole').addEventListener('change', function() {
            const fieldSection = document.getElementById('fieldSection');
            fieldSection.style.display = this.value === 'petani' ? 'block' : 'none';
        });

        // Fungsi untuk menambah ke keranjang
        function addToCart(productId, productName, price, image) {
            console.log('Adding to cart:', { productId, productName, price, image });
            
            fetch('backend/api/cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'add',
                    product_id: productId,
                    nama_produk: productName,
                    harga: price,
                    gambar: image
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Add to cart response:', data);
                if(data.success) {
                    showAlert(data.message, 'success');
                    updateCartCount(data.cart_count);
                } else {
                    showAlert('Gagal menambahkan produk ke keranjang: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan: ' + error.message, 'error');
            });
        }

        // Fungsi untuk menampilkan alert
        function showAlert(message, type) {
            // Hapus alert sebelumnya
            const existingAlert = document.querySelector('.alert-notification');
            if (existingAlert) {
                existingAlert.remove();
            }

            // Buat alert baru
            const alert = document.createElement('div');
            alert.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show alert-notification`;
            alert.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check' : 'exclamation-triangle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(alert);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                if(alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 3000);
        }

        // Fungsi untuk update cart count di navbar
        function updateCartCount(count) {
            let cartBadge = document.getElementById('cart-badge');
            if (!cartBadge) {
                // Create cart badge if not exists
                const cartLinks = document.querySelectorAll('a[href="cart.php"]');
                if (cartLinks.length > 0) {
                    const cartLink = cartLinks[0];
                    cartBadge = document.createElement('span');
                    cartBadge.id = 'cart-badge';
                    cartBadge.className = 'badge bg-danger rounded-pill';
                    cartLink.appendChild(cartBadge);
                }
            }
            
            if (cartBadge) {
                cartBadge.textContent = count;
                cartBadge.style.display = count > 0 ? 'inline' : 'none';
            }
        }

        // Debug: lihat isi cart saat load
        console.log('Marketplace loaded');
        fetch('backend/api/cart.php')
            .then(response => response.json())
            .then(data => console.log('Current cart:', data));
    </script>
</body>
</html>