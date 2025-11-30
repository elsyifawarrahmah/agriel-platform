<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tentang Kami - AgriEl</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .mission-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .mission-card:hover {
            transform: translateY(-5px);
        }
        .team-member {
            text-align: center;
            padding: 20px;
        }
        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: #28a745;
        }
        .value-item {
            padding: 15px;
            border-radius: 10px;
            background: #f8f9fa;
            margin-bottom: 15px;
        }
        .credit-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
            border-radius: 15px;
            margin: 40px 0;
        }
    </style>
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
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="marketplace.php">Pasar Digital</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="articles.php">Edukasi</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="consultation.php">Konsultasi</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 active" href="about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.php">Kontak</a></li>
                    
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
                    <div class="site-heading text-white text-center">
                        <h1><i class="fas fa-info-circle me-2"></i>Tentang AgriEl</h1>
                        <span class="subheading">Platform Digital untuk Pertanian Modern</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content-->
    <div class="container px-4 px-lg-5 mt-5">
        <!-- Credit Section -->
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="credit-section text-center">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <i class="fas fa-heart fa-3x mb-3"></i>
                            <h3>Dibuat dengan ❤️ oleh</h3>
                            <h2 class="mb-3">El-Syifa Warrahmah</h2>
                            <p class="lead mb-3">
                                Mahasiswa Politeknik Negeri Padang<br>
                                Jurusan Teknologi Informasi D3 - Teknik Komputer
                            </p>
                            <p>
                                "Website AgriEl ini dibuat sebagai wujud dedikasi untuk memajukan pertanian Indonesia 
                                melalui teknologi digital. Semoga platform ini dapat memberikan manfaat bagi petani 
                                dan masyarakat luas."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visi Misi Section -->
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h2 class="section-heading">Siapa Kami?</h2>
                    <p class="lead">AgriEl adalah platform digital revolusioner yang didedikasikan untuk memajukan sektor pertanian Indonesia melalui integrasi teknologi modern.</p>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card mission-card h-100">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-bullseye fa-3x text-primary mb-3"></i>
                                <h4 class="card-title">Visi Kami</h4>
                                <p class="card-text">Menjadi platform digital terdepan yang mentransformasi pertanian Indonesia menjadi lebih modern, efisien, dan berkelanjutan, menciptakan ekosistem pertanian yang terhubung secara digital.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card mission-card h-100">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-tasks fa-3x text-success mb-3"></i>
                                <h4 class="card-title">Misi Kami</h4>
                                <ul class="list-unstyled text-start">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Memodernisasi praktik pertanian tradisional</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Meningkatkan akses pasar untuk petani lokal</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Menyediakan edukasi pertanian terkini</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Membangun komunitas petani yang kolaboratif</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="bg-light rounded p-5">
                    <div class="row text-center">
                        <div class="col-md-3 mb-4">
                            <div class="stat-number">500+</div>
                            <p class="text-muted">Petani Terdaftar</p>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-number">1.200+</div>
                            <p class="text-muted">Produk Tersedia</p>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-number">50+</div>
                            <p class="text-muted">Ahli Pertanian</p>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="stat-number">15+</div>
                            <p class="text-muted">Kota Terjangkau</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nilai Perusahaan -->
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-10">
                <h2 class="text-center mb-4">Nilai-Nilai Kami</h2>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="value-item">
                            <h5><i class="fas fa-handshake text-primary me-2"></i>Kolaborasi</h5>
                            <p class="mb-0">Kami percaya pada kekuatan kolaborasi antara petani, ahli, dan konsumen untuk menciptakan solusi yang lebih baik.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="value-item">
                            <h5><i class="fas fa-lightbulb text-warning me-2"></i>Inovasi</h5>
                            <p class="mb-0">Terus berinovasi dan mengembangkan teknologi untuk memecahkan masalah pertanian yang kompleks.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="value-item">
                            <h5><i class="fas fa-shield-alt text-success me-2"></i>Keberlanjutan</h5>
                            <p class="mb-0">Berkomitmen pada praktik pertanian yang berkelanjutan dan ramah lingkungan untuk masa depan yang lebih baik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Layanan Kami -->
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-10">
                <h2 class="text-center mb-4">Layanan Kami</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 text-center">
                            <div class="card-body">
                                <i class="fas fa-shopping-basket fa-2x text-success mb-3"></i>
                                <h5>Pasar Digital</h5>
                                <p>Platform jual-beli produk pertanian langsung dari petani ke konsumen dengan sistem yang aman, transparan, dan menguntungkan kedua belah pihak.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 text-center">
                            <div class="card-body">
                                <i class="fas fa-graduation-cap fa-2x text-primary mb-3"></i>
                                <h5>Edukasi</h5>
                                <p>Artikel, tutorial video, dan panduan lengkap tentang teknik pertanian modern, pemupukan, pengendalian hama, dan best practices lainnya.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 text-center">
                            <div class="card-body">
                                <i class="fas fa-comments fa-2x text-info mb-3"></i>
                                <h5>Konsultasi</h5>
                                <p>Konsultasi langsung dengan ahli pertanian berpengalaman untuk solusi masalah spesifik yang dihadapi dalam budidaya tanaman.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesan dari Pembuat -->
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-10">
                <div class="card border-success">
                    <div class="card-header bg-success text-white text-center">
                        <h4 class="mb-0"><i class="fas fa-quote-left me-2"></i>Pesan dari Pembuat</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <img src="assets/img/image.jpg" 
                                     class="rounded-circle img-fluid" alt="El-Syifa Warrahmah">
                            </div>
                            <div class="col-md-9">
                                <blockquote class="blockquote">
                                    <p class="mb-3"><i>"Sebagai mahasiswa Teknologi Informasi, saya percaya bahwa teknologi harus dapat diakses dan bermanfaat bagi semua kalangan, termasuk para petani yang menjadi tulang punggung ketahanan pangan nasional. AgriEl hadir sebagai jembatan antara teknologi modern dengan dunia pertanian tradisional, dengan harapan dapat meningkatkan kesejahteraan petani Indonesia."</i></p>
                                    <footer class="blockquote-footer mt-3">
                                        <strong>El-Syifa Warrahmah</strong><br>
                                        <small>Mahasiswa Politeknik Negeri Padang - Jurusan Teknologi Informasi D3 Teknik Komputer</small>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimoni -->
        <div class="row gx-4 gx-lg-5 justify-content-center mt-5">
            <div class="col-lg-10">
                <h2 class="text-center mb-4">Apa Kata Pengguna AgriEl?</h2>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><i>"Berkat AgriEl, saya bisa menjual hasil panen langsung ke konsumen dengan harga yang lebih baik, tanpa melalui tengkulak. Platform yang sangat membantu petani kecil seperti saya."</i></p>
                                <div class="d-flex align-items-center">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=50&h=50&fit=crop&crop=face" 
                                         class="rounded-circle me-3" alt="Petani">
                                    <div>
                                        <h6 class="mb-0">Pak Joko</h6>
                                        <small class="text-muted">Petani Sayuran Organik, Bogor</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><i>"Sebagai petani muda, AgriEl sangat membantu saya belajar teknik pertanian modern. Fitur konsultasinya sangat berguna ketika menghadapi masalah di lapangan."</i></p>
                                <div class="d-flex align-items-center">
                                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=50&h=50&fit=crop&crop=face" 
                                         class="rounded-circle me-3" alt="Petani Muda">
                                    <div>
                                        <h6 class="mb-0">Maya Sari</h6>
                                        <small class="text-muted">Petani Muda, Bandung</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer-->
    <footer class="border-top mt-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="small text-center text-muted fst-italic">
                        <i class="fas fa-seedling me-1"></i> Copyright © AgriEl 2025 - Platform Digital Pertanian<br>
                        <small>Dikembangkan oleh El-Syifa Warrahmah - Politeknik Negeri Padang</small>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>