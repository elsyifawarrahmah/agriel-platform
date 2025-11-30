<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kontak - AgriEl</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .contact-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .contact-icon {
            width: 60px;
            height: 60px;
            background: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 1.5rem;
        }
        .map-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="marketplace.php">Pasar Digital</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="articles.php">Edukasi</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="consultation.php">Konsultasi</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 active" href="contact.php">Kontak</a></li>
                    
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

    <header class="masthead" style="background-image: url('https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading text-white">
                        <h1>Hubungi Kami</h1>
                        <span class="subheading">Punya pertanyaan? Kami siap membantu Anda.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="mb-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p class="text-center mb-5">Ingin menghubungi kami? Isi form di bawah ini untuk mengirim pesan dan kami akan membalas secepat mungkin!</p>
                    
                    <!-- Contact Form -->
                    <div class="card contact-card">
                        <div class="card-body p-4">
                            <h4 class="card-title text-center mb-4"><i class="fas fa-envelope me-2"></i>Kirim Pesan</h4>
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" id="name" name="name" type="text" placeholder="Nama lengkap Anda..." required />
                                            <label for="name">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Email Anda..." required />
                                            <label for="email">Alamat Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input class="form-control" id="subject" name="subject" type="text" placeholder="Subjek pesan..." required />
                                        <label for="subject">Subjek</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="message" name="message" placeholder="Tulis pesan Anda di sini..." style="height: 150px" required></textarea>
                                        <label for="message">Pesan</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-lg" type="submit">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="text-center mb-4">Informasi Kontak</h3>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card contact-card text-center h-100">
                                <div class="card-body">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <h5>Alamat Kantor</h5>
                                    <p class="text-muted">
                                        Politeknik Negeri Padang<br>
                                        Jl. Kampus Politeknik Negeri Padang<br>
                                        Limau Manis, Padang<br>
                                        Sumatera Barat 25164
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card contact-card text-center h-100">
                                <div class="card-body">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <h5>Telepon</h5>
                                    <p class="text-muted">
                                        +62 751 72566<br>
                                        +62 812 3456 7890 (WhatsApp)
                                    </p>
                                    <a href="tel:+6275172566" class="btn btn-outline-primary btn-sm">Hubungi Sekarang</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card contact-card text-center h-100">
                                <div class="card-body">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h5>Email</h5>
                                    <p class="text-muted">
                                        info@agriel.com<br>
                                        support@agriel.com
                                    </p>
                                    <a href="mailto:info@agriel.com" class="btn btn-outline-primary btn-sm">Kirim Email</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="text-center mb-4">Lokasi Kami</h3>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.3179999999993!2d100.399461!3d-0.914722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8a3a8a9a9a9%3A0x2fd4b8a3a8a9a9a9!2sPoliteknik%20Negeri%20Padang!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" 
                            width="100%" 
                            height="400" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="text-center mb-4">Tim Pengembang AgriEl</h3>
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                    <h6>Elsyifa</h6>
                                    <p class="text-muted small">Project Manager</p>
                                    <p class="small">Mahasiswa Politeknik Negeri Padang</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                    <h6>Deni Satria</h6>
                                    <p class="text-muted small">Backend Developer</p>
                                    <p class="small">Spesialis Database & API</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                    <h6>Warrahmah</h6>
                                    <p class="text-muted small">Frontend Developer</p>
                                    <p class="small">UI/UX Designer & Developer</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                    <h6>AgriEl Team</h6>
                                    <p class="text-muted small">Support Team</p>
                                    <p class="small">Customer Service & Support</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="text-center mb-4">Pertanyaan Umum</h3>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Bagaimana cara bergabung sebagai petani di AgriEl?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Daftar akun dengan memilih peran "Petani" saat registrasi. Isi informasi lengkap tentang bidang pertanian Anda, lalu Anda bisa mulai menjual produk di pasar digital kami.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apakah ada biaya untuk menggunakan platform AgriEl?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Platform AgriEl gratis digunakan untuk semua pengguna. Tidak ada biaya pendaftaran atau komisi untuk penjualan produk.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Bagaimana sistem pengiriman produk?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Pengiriman disepakati antara penjual dan pembeli. Kami menyediakan informasi kontak untuk koordinasi pengiriman langsung.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="border-top mt-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="small text-center text-muted fst-italic">
                        <i class="fas fa-seedling me-1"></i> AgriEl 2025 - Platform untuk Petani Indonesia<br>
                        <small>Dikembangkan oleh Mahasiswa Politeknik Negeri Padang</small>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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
        document.getElementById('regRole').addEventListener('change', function() {
            const fieldSection = document.getElementById('fieldSection');
            fieldSection.style.display = this.value === 'petani' ? 'block' : 'none';
        });
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            
            if (name && email && subject && message) {
                alert('Pesan berhasil dikirim! Kami akan membalas pesan Anda secepatnya.\n\nTerima kasih telah menghubungi AgriEl - Politeknik Negeri Padang.');

                this.reset();
            } else {
                alert('Harap isi semua field yang diperlukan.');
            }
        });

        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-bs-target');
                document.querySelector(target).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    
                    fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        alert('Error: ' + error.message);
                    });
                });
            }
            const registerForm = document.getElementById('registerForm');
            if (registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    
                    fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        alert('Error: ' + error.message);
                    });
                });
            }
        });
    </script>
</body>
</html>