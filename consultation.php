<?php
session_start();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_question'])) {
    $question = $_POST['question'] ?? '';
    $category = $_POST['category'] ?? 'umum';
    
    if (!empty($question)) {
        // Simpan ke session sebagai contoh (bisa diganti dengan database)
        if (!isset($_SESSION['consultations'])) {
            $_SESSION['consultations'] = [];
        }
        
        $_SESSION['consultations'][] = [
            'question' => $question,
            'category' => $category,
            'timestamp' => date('Y-m-d H:i:s'),
            'status' => 'pending'
        ];
        
        $success_message = "Pertanyaan Anda telah dikirim! Ahli kami akan segera merespons.";
    } else {
        $error_message = "Silakan tulis pertanyaan Anda.";
    }
}

// Data ahli statis (tanpa database)
$experts = [
    [
        'name' => 'Dr. Ahmad Santoso',
        'field' => 'Tanaman Pangan',
        'experience' => '15 tahun',
        'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=150&h=150&fit=crop&crop=face'
    ],
    [
        'name' => 'Ir. Siti Rahayu',
        'field' => 'Hortikultura',
        'experience' => '12 tahun', 
        'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face'
    ],
    [
        'name' => 'Prof. Bambang Wijaya',
        'field' => 'Pemupukan & Tanah',
        'experience' => '20 tahun',
        'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Konsultasi - AgriEl</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
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
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 active" href="consultation.php">Konsultasi</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.php">Tentang</a></li>
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
    <header class="masthead" style="background-image: url('https://images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading text-white text-center">
                        <h1><i class="fas fa-comments me-2"></i>Konsultasi Pertanian</h1>
                        <span class="subheading">Tanya langsung pada ahli pertanian kami</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content-->
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                
                <!-- Success/Error Messages -->
                <?php if(isset($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <?php if(isset($error_message)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <!-- Consultation Form -->
                <div class="card mb-5">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-question-circle me-2"></i>Ajukan Pertanyaan</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori Pertanyaan</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="umum">Umum</option>
                                    <option value="tanaman-pangan">Tanaman Pangan</option>
                                    <option value="hortikultura">Hortikultura</option>
                                    <option value="pemupukan">Pemupukan</option>
                                    <option value="hama-penyakit">Hama & Penyakit</option>
                                    <option value="teknologi">Teknologi Pertanian</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="question" class="form-label">Pertanyaan Anda</label>
                                <textarea class="form-control" id="question" name="question" rows="6" 
                                          placeholder="Tulis pertanyaan detail tentang masalah pertanian Anda..." 
                                          required><?php echo $_POST['question'] ?? ''; ?></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="submit_question" class="btn btn-success btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pertanyaan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Experts Section -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-users me-2"></i>Ahli Pertanian Kami</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach($experts as $expert): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 text-center">
                                    <div class="card-body">
                                        <img src="<?php echo $expert['image']; ?>" 
                                             class="rounded-circle mb-3" 
                                             alt="<?php echo $expert['name']; ?>"
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                        <h5 class="card-title"><?php echo $expert['name']; ?></h5>
                                        <p class="card-text text-success fw-bold"><?php echo $expert['field']; ?></p>
                                        <p class="card-text text-muted">
                                            <small>Pengalaman: <?php echo $expert['experience']; ?></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="card mt-5">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Pertanyaan Umum</h4>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        Bagaimana cara mengatasi hama wereng pada padi?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Gunakan pestisida nabati atau kimia sesuai dosis, rotasi tanaman, dan jaga kebersihan sawah.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        Kapan waktu terbaik untuk memupuk tanaman?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Pagi hari sebelum jam 9 atau sore hari setelah jam 4, hindari saat matahari terik.
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
                        <i class="fas fa-seedling me-1"></i> AgriEl 2025 - Platform untuk Petani Indonesia
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>