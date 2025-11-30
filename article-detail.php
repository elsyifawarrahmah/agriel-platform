<?php
session_start();

// Sample article data (in real app, this would come from database)
$articles = [
    1 => [
        'title' => 'Cara Bertani Padi Organik',
        'author' => 'Dr. Ahmad Wijaya',
        'author_title' => 'Ahli Pertanian Organik',
        'author_avatar' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=100&h=100&fit=crop&crop=face',
        'read_time' => '5 min read',
        'category' => 'Organik',
        'image' => 'https://images.unsplash.com/photo-1621344040666-7eaa34434a05?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        'content' => '
            <h3>Pendahuluan</h3>
            <p>Pertanian padi organik adalah metode budidaya padi yang mengutamakan kelestarian lingkungan dan kesehatan konsumen. Dengan menghindari penggunaan bahan kimia sintetis, pertanian organik menghasilkan beras yang lebih sehat dan ramah lingkungan.</p>
            
            <h3>Persiapan Lahan</h3>
            <p>Lahan untuk padi organik harus dipersiapkan dengan baik:</p>
            <ul>
                <li>Bersihkan lahan dari gulma dan sisa tanaman sebelumnya</li>
                <li>Lakukan pengolahan tanah minimal 2 minggu sebelum tanam</li>
                <li>Berikan pupuk kandang atau kompos sebanyak 10-20 ton per hektar</li>
                <li>Pastikan sistem irigasi berfungsi dengan baik</li>
            </ul>
            
            <h3>Pemilihan Benih</h3>
            <p>Pilih benih padi varietas unggul yang adaptif dengan kondisi lokal. Beberapa varietas yang recommended:</p>
            <ul>
                <li>Varietas Inpari 32: Tahan hama wereng</li>
                <li>Varietas Mentik Wangi: Beraroma harum</li>
                <li>Varietas Ciherang: Produktivitas tinggi</li>
            </ul>
            
            <h3>Teknik Penanaman</h3>
            <p>Gunakan sistem jajar legowo 2:1 atau 4:1 untuk optimalisasi sinar matahari dan sirkulasi udara. Jarak tanam yang disarankan adalah 25x25 cm.</p>
            
            <h3>Pemeliharaan</h3>
            <p>Lakukan penyiangan secara manual atau menggunakan alat penyiang mekanis. Untuk pengendalian hama, gunakan pestisida nabati dari ekstrak daun mimba atau tembakau.</p>
            
            <h3>Panen dan Pasca Panen</h3>
            <p>Panen dilakukan ketika 90% gabah telah menguning. Proses penanganan pasca panen harus menjaga kualitas beras organik dengan menghindari kontaminasi bahan kimia.</p>
            
            <div class="alert alert-success mt-4">
                <i class="fas fa-lightbulb me-2"></i>
                <strong>Tips Sukses:</strong> Lakukan rotasi tanaman dengan kacang-kacangan untuk menjaga kesuburan tanah.
            </div>
        '
    ],
    2 => [
        'title' => 'Pengendalian Hama Terpadu',
        'author' => 'Prof. Siti Rahayu',
        'author_title' => 'Ahli Hama dan Penyakit Tanaman',
        'author_avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face',
        'read_time' => '7 min read',
        'category' => 'Hama & Penyakit',
        'image' => 'https://images.unsplash.com/photo-1613478223719-2ab802602423?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        'content' => '
            <h3>Konsep PHT</h3>
            <p>Pengendalian Hama Terpadu (PHT) adalah pendekatan holistik yang mengintegrasikan berbagai metode pengendalian hama secara bijaksana.</p>
            
            <h3>Prinsip Dasar PHT</h3>
            <ol>
                <li>Budidaya tanaman sehat</li>
                <li>Pelestarian musuh alami</li>
                <li>Pengamatan rutin</li>
                <li>Petani sebagai ahli PHT</li>
            </ol>
            
            <h3>Teknik Pengendalian</h3>
            <p>Kombinasikan berbagai teknik untuk hasil optimal...</p>
        '
    ]
    // Add other articles similarly...
];

$article_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$article = isset($articles[$article_id]) ? $articles[$article_id] : $articles[1];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article['title']; ?> - AgriEl</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .article-header {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?php echo $article['image']; ?>');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
        }
        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }
        .article-content h3 {
            color: #28a745;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .article-content ul, .article-content ol {
            margin-bottom: 1.5rem;
        }
        .author-card {
            border-left: 4px solid #28a745;
        }
    </style>
</head>
<body>
    <!-- Navigation (same as articles.php) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-seedling me-2 text-success"></i>AgriEl
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="articles.php"><i class="fas fa-arrow-left me-1"></i>Kembali ke Artikel</a>
            </div>
        </div>
    </nav>

    <!-- Article Header -->
    <section class="article-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <span class="badge bg-success fs-6 mb-3"><?php echo $article['category']; ?></span>
                    <h1 class="display-4 fw-bold mb-4"><?php echo $article['title']; ?></h1>
                    <div class="d-flex justify-content-center align-items-center text-light">
                        <img src="<?php echo $article['author_avatar']; ?>" 
                             class="rounded-circle me-3" 
                             width="50" height="50" 
                             alt="<?php echo $article['author']; ?>">
                        <div class="text-start">
                            <h6 class="mb-0"><?php echo $article['author']; ?></h6>
                            <small><?php echo $article['author_title']; ?></small>
                        </div>
                        <span class="mx-3">•</span>
                        <span><i class="fas fa-clock me-1"></i><?php echo $article['read_time']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="article-content">
                        <?php echo $article['content']; ?>
                    </div>
                    
                    <!-- Author Info -->
                    <div class="card author-card mt-5">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="<?php echo $article['author_avatar']; ?>" 
                                         class="rounded-circle" 
                                         width="80" height="80" 
                                         alt="<?php echo $article['author']; ?>">
                                </div>
                                <div class="col">
                                    <h5><?php echo $article['author']; ?></h5>
                                    <p class="text-muted mb-2"><?php echo $article['author_title']; ?></p>
                                    <p class="mb-0">Ahli pertanian dengan pengalaman lebih dari 15 tahun dalam bidang pertanian organik dan berkelanjutan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                        <a href="articles.php" class="btn btn-outline-success">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Artikel
                        </a>
                        <div>
                            <button class="btn btn-outline-primary me-2">
                                <i class="fas fa-share-alt me-2"></i>Bagikan
                            </button>
                            <button class="btn btn-outline-danger">
                                <i class="fas fa-heart me-2"></i>Suka
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    <section class="py-5 bg-light">
        <div class="container">
            <h3 class="text-center mb-5">Artikel Terkait</h3>
            <div class="row">
                <!-- Related article cards here -->
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1574943320219-553eb213f72d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             class="card-img-top" alt="Kompos Organik">
                        <div class="card-body">
                            <h5 class="card-title">Pembuatan Kompos Organik</h5>
                            <a href="article-detail.php?id=7" class="btn btn-outline-success btn-sm">Baca</a>
                        </div>
                    </div>
                </div>
                <!-- Add more related articles -->
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 AgriEl - Platform Edukasi Pertanian</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>