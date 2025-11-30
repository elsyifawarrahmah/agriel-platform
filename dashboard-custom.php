<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AgriEl</title>
    <style>
        :root {
            --primary: #2e7d32;
            --primary-dark: #1b5e20;
            --primary-light: #4caf50;
            --secondary: #ff9800;
            --accent: #7cb342;
            --text: #333333;
            --text-light: #666666;
            --background: #f8f9fa;
            --card-bg: #ffffff;
            --border: #e0e0e0;
            --success: #4caf50;
            --warning: #ff9800;
            --danger: #f44336;
            --info: #2196f3;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.6;
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            grid-template-rows: 70px 1fr;
            grid-template-areas: 
                "sidebar header"
                "sidebar main";
            min-height: 100vh;
        }

        .header {
            grid-area: header;
            background: var(--card-bg);
            border-bottom: 2px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .sidebar {
            grid-area: sidebar;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 2rem 0;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
            padding: 0 1rem;
        }

        .logo h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .logo .tagline {
            font-size: 0.8rem;
            opacity: 0.8;
            margin-top: 0.5rem;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: var(--accent);
        }

        .nav-icon {
            margin-right: 1rem;
            width: 20px;
            text-align: center;
        }

        .main-content {
            grid-area: main;
            padding: 2rem;
            overflow-y: auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-left: 4px solid var(--primary);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .stat-card.success { border-left-color: var(--success); }
        .stat-card.info { border-left-color: var(--info); }
        .stat-card.warning { border-left-color: var(--warning); }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .stat-trend {
            display: flex;
            align-items: center;
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .trend-up { color: var(--success); }
        .trend-down { color: var(--danger); }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
            color: var(--text);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .action-card:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
        }

        .action-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.2rem;
        }

        .table-container {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .table-controls {
            display: flex;
            gap: 1rem;
        }

        .search-box {
            position: relative;
        }

        .search-input {
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            width: 250px;
        }

        .search-icon {
            position: absolute;
            left: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .table th {
            background: var(--background);
            font-weight: 600;
            color: var(--text-light);
        }

        .table tr:hover {
            background: var(--background);
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .badge-success { background: #e8f5e8; color: var(--success); }
        .badge-warning { background: #fff3e0; color: var(--warning); }
        .badge-secondary { background: #f5f5f5; color: var(--text-light); }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text);
        }

        .btn-outline:hover {
            background: var(--background);
        }

        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
                grid-template-areas: 
                    "header"
                    "main";
            }
            
            .sidebar {
                display: none;
            }
            
            .charts-grid {
                grid-template-columns: 1fr;
            }
            
            .search-input {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <header class="header">
            <div class="header-title">
                <i class="fas fa-seedling"></i> AgriEl Dashboard
            </div>
            <div class="user-menu">
                <div class="user-info">
                    <div class="user-name" id="userName">Loading...</div>
                    <div class="user-role" id="userRole" style="font-size: 0.8rem; color: var(--text-light);"></div>
                </div>
                <div class="user-avatar" id="userAvatar">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </header>
        <nav class="sidebar">
            <div class="logo">
                <h1><i class="fas fa-seedling"></i> AgriEl</h1>
                <div class="tagline">Platform Pertanian Digital</div>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#overview" class="nav-link active" data-tab="overview">
                        <span class="nav-icon"><i class="fas fa-chart-pie"></i></span>
                        Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#products" class="nav-link" data-tab="products">
                        <span class="nav-icon"><i class="fas fa-shopping-basket"></i></span>
                        Kelola Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#orders" class="nav-link" data-tab="orders">
                        <span class="nav-icon"><i class="fas fa-shopping-cart"></i></span>
                        Pesanan
                        <span class="badge badge-warning" style="margin-left: auto;">3</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#articles" class="nav-link" data-tab="articles">
                        <span class="nav-icon"><i class="fas fa-newspaper"></i></span>
                        Artikel Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#consultations" class="nav-link" data-tab="consultations">
                        <span class="nav-icon"><i class="fas fa-comments"></i></span>
                        Konsultasi
                        <span class="badge badge-warning" style="margin-left: auto;">5</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#reports" class="nav-link" data-tab="reports">
                        <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
                        Laporan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#profile" class="nav-link" data-tab="profile">
                        <span class="nav-icon"><i class="fas fa-user-cog"></i></span>
                        Pengaturan Profil
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-danger" onclick="logout()">
                        <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
        <main class="main-content">
            <div class="tab-content active" id="overview">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-label">Total Produk</div>
                        <div class="stat-value" id="totalProducts">0</div>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
                        </div>
                    </div>
                    <div class="stat-card success">
                        <div class="stat-label">Pendapatan Bulan Ini</div>
                        <div class="stat-value" id="totalRevenue">Rp 0</div>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i> 8% growth
                        </div>
                    </div>
                    <div class="stat-card info">
                        <div class="stat-label">Total Artikel</div>
                        <div class="stat-value" id="totalArticles">0</div>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-eye"></i> 1.2K views
                        </div>
                    </div>
                    <div class="stat-card warning">
                        <div class="stat-label">Konsultasi Baru</div>
                        <div class="stat-value" id="totalConsultations">0</div>
                        <div class="stat-trend trend-down">
                            <i class="fas fa-clock"></i> 5 menunggu
                        </div>
                    </div>
                </div>
                <div class="quick-actions">
                    <a href="#products" class="action-card" data-tab="products">
                        <div class="action-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h4>Tambah Produk</h4>
                        <p>Jual produk pertanian Anda</p>
                    </a>
                    <a href="#articles" class="action-card" data-tab="articles">
                        <div class="action-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h4>Tulis Artikel</h4>
                        <p>Bagikan pengetahuan pertanian</p>
                    </a>
                    <a href="#consultations" class="action-card" data-tab="consultations">
                        <div class="action-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h4>Lihat Konsultasi</h4>
                        <p>Bantu petani lainnya</p>
                    </a>
                    <a href="#reports" class="action-card" data-tab="reports">
                        <div class="action-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Analisis Data</h4>
                        <p>Lihat laporan performa</p>
                    </a>
                </div>
                <div class="charts-grid">
                    <div class="chart-card">
                        <div class="chart-title">Statistik Penjualan 7 Hari Terakhir</div>
                        <canvas id="salesChart" height="250"></canvas>
                    </div>
                    <div class="chart-card">
                        <div class="chart-title">Kategori Produk</div>
                        <canvas id="categoryChart" height="250"></canvas>
                    </div>
                </div>
                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Produk Terbaru</div>
                        <a href="#products" class="btn btn-outline" data-tab="products">
                            Lihat Semua <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="recentProducts">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-content" id="products">
                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Kelola Produk</div>
                        <div class="table-controls">
                            <div class="search-box">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" class="search-input" placeholder="Cari produk..." id="searchProducts">
                            </div>
                            <select class="search-input" id="filterCategory">
                                <option value="">Semua Kategori</option>
                                <option value="Padi & Beras">Padi & Beras</option>
                                <option value="Sayuran">Sayuran</option>
                                <option value="Buah-buahan">Buah-buahan</option>
                                <option value="Jagung">Jagung</option>
                            </select>
                            <button class="btn btn-primary" onclick="showProductModal()">
                                <i class="fas fa-plus"></i> Tambah Produk
                            </button>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="productsTable">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-content" id="articles">
                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Artikel Saya</div>
                        <div class="table-controls">
                            <button class="btn btn-primary" onclick="showArticleModal()">
                                <i class="fas fa-plus"></i> Tulis Artikel
                            </button>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Views</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="articlesTable">
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div id="productModal" class="modal" style="display: none;">
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script src="js/auth.js"></script>
    <script src="js/dashboard-custom.js"></script>
</body>
</html>