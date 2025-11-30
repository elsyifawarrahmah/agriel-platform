<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriEl - Dashboard Petani</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --secondary: #ff9800;
            --light: #f5f5f5;
            --dark: #333;
            --gray: #e0e0e0;
            --danger: #f44336;
            --success: #4caf50;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            color: var(--dark);
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom, var(--primary), var(--primary-dark));
            color: white;
            padding: 20px 0;
            transition: all 0.3s;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }
        
        .logo h1 {
            font-size: 24px;
            font-weight: 700;
        }
        
        .logo span {
            color: var(--secondary);
        }
        
        .nav-links {
            list-style: none;
            padding: 0 15px;
        }
        
        .nav-links li {
            margin-bottom: 10px;
        }
        
        .nav-links a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .nav-links a:hover, .nav-links a.active {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .nav-links i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--gray);
        }
        
        .header h2 {
            color: var(--primary);
            font-weight: 600;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        /* Stats Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card {
            display: flex;
            align-items: center;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }
        
        .icon-1 {
            background-color: rgba(46, 125, 50, 0.1);
            color: var(--primary);
        }
        
        .icon-2 {
            background-color: rgba(255, 152, 0, 0.1);
            color: var(--secondary);
        }
        
        .icon-3 {
            background-color: rgba(76, 175, 80, 0.1);
            color: var(--success);
        }
        
        .stat-info h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
        }
        
        /* Products Section */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .section-header h3 {
            color: var(--primary);
            font-weight: 600;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #e68900;
        }
        
        /* Products Table */
        .products-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background-color: var(--primary);
            color: white;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
        }
        
        tbody tr {
            border-bottom: 1px solid var(--gray);
        }
        
        tbody tr:last-child {
            border-bottom: none;
        }
        
        tbody tr:hover {
            background-color: rgba(46, 125, 50, 0.05);
        }
        
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-active {
            background-color: rgba(76, 175, 80, 0.2);
            color: var(--success);
        }
        
        .status-inactive {
            background-color: rgba(244, 67, 54, 0.2);
            color: var(--danger);
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-edit {
            background-color: rgba(33, 150, 243, 0.1);
            color: #2196f3;
        }
        
        .btn-delete {
            background-color: rgba(244, 67, 54, 0.1);
            color: var(--danger);
        }
        
        .btn-action:hover {
            transform: scale(1.1);
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #ccc;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        
        .modal-header {
            padding: 20px;
            background-color: var(--primary);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h3 {
            font-weight: 600;
        }
        
        .close-modal {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--gray);
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            outline: none;
        }
        
        .image-upload {
            border: 2px dashed var(--gray);
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .image-upload:hover {
            border-color: var(--primary);
        }
        
        .image-upload i {
            font-size: 48px;
            color: #ccc;
            margin-bottom: 15px;
        }
        
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            margin-top: 15px;
            display: none;
            border-radius: 8px;
        }
        
        .camera-container {
            display: none;
            flex-direction: column;
            align-items: center;
            margin-top: 15px;
        }
        
        #cameraPreview {
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
        }
        
        .camera-controls {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .modal-footer {
            padding: 20px;
            background-color: #f5f5f5;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        /* Chart Styles */
        .chart-container {
            width: 100%;
            height: 300px;
            margin-top: 20px;
        }
        
        /* Tabs */
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--gray);
        }
        
        .tab {
            padding: 12px 20px;
            cursor: pointer;
            font-weight: 600;
            color: #666;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .tab.active {
            color: var(--primary);
            border-bottom: 3px solid var(--primary);
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
            }
            
            .nav-links {
                display: flex;
                overflow-x: auto;
            }
            
            .nav-links li {
                margin-bottom: 0;
                margin-right: 10px;
            }
            
            .nav-links a {
                white-space: nowrap;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="logo">
            <h1>Agri<span>El</span> Dashboard</h1>
        </div>
        <ul class="nav-links">
            <li><a href="#" class="active"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
            <li><a href="#" id="productsTabBtn"><i class="fas fa-box"></i> Kelola Produk</a></li>
            <li><a href="#" id="salesTabBtn"><i class="fas fa-chart-bar"></i> Statistik Penjualan</a></li>
            <li><a href="index.php"><i class="fas fa-home"></i> Kembali ke Beranda</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2>Dashboard Petani</h2>
            <div class="user-info">
                <div class="user-avatar">PT</div>
                <span>Petani Terdaftar</span>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <div class="tab active" id="dashboardTab">Dashboard</div>
            <div class="tab" id="productsTab">Kelola Produk</div>
            <div class="tab" id="salesTab">Statistik Penjualan</div>
        </div>

        <!-- Dashboard Tab Content -->
        <div class="tab-content active" id="dashboardContent">
            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="card stat-card">
                    <div class="stat-icon icon-1">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-info">
                        <h3>TOTAL PRODUK</h3>
                        <p id="totalProducts">0</p>
                    </div>
                </div>
                <div class="card stat-card">
                    <div class="stat-icon icon-2">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-info">
                        <h3>PENJUALAN BULAN INI</h3>
                        <p id="monthlySales">0</p>
                    </div>
                </div>
                <div class="card stat-card">
                    <div class="stat-icon icon-3">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="stat-info">
                        <h3>PENDAPATAN</h3>
                        <p id="totalRevenue">Rp 0</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="section-header">
                    <h3>Produk Terbaru</h3>
                    <button class="btn btn-primary" id="addProductBtn">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </button>
                </div>
                
                <div class="products-table">
                    <table>
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
                        <tbody id="productsTableBody">
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fas fa-box-open"></i>
                                    <p>Belum ada produk. Tambah produk pertama Anda!</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Products Tab Content -->
        <div class="tab-content" id="productsContent">
            <div class="card">
                <div class="section-header">
                    <h3>Semua Produk</h3>
                    <button class="btn btn-primary" id="addProductBtn2">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </button>
                </div>
                
                <div class="products-table">
                    <table>
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
                        <tbody id="allProductsTableBody">
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fas fa-box-open"></i>
                                    <p>Belum ada produk. Tambah produk pertama Anda!</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sales Tab Content -->
        <div class="tab-content" id="salesContent">
            <div class="card">
                <h3>Statistik Penjualan</h3>
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
            
            <div class="stats-cards">
                <div class="card stat-card">
                    <div class="stat-icon icon-1">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-info">
                        <h3>TOTAL PENJUALAN</h3>
                        <p id="totalSales">0</p>
                    </div>
                </div>
                <div class="card stat-card">
                    <div class="stat-icon icon-2">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="stat-info">
                        <h3>PENDAPATAN BULAN INI</h3>
                        <p id="monthlyRevenue">Rp 0</p>
                    </div>
                </div>
                <div class="card stat-card">
                    <div class="stat-icon icon-3">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-info">
                        <h3>PRODUK TERLARIS</h3>
                        <p id="bestSeller">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal" id="productModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Produk Baru</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <div class="form-group">
                        <label for="productName">Nama Produk</label>
                        <input type="text" id="productName" class="form-control" placeholder="Masukkan nama produk">
                    </div>
                    
                    <div class="form-group">
                        <label for="productCategory">Kategori</label>
                        <select id="productCategory" class="form-control">
                            <option value="">Pilih kategori</option>
                            <option value="sayuran">Sayuran</option>
                            <option value="buah">Buah-buahan</option>
                            <option value="bibit">Bibit</option>
                            <option value="pupuk">Pupuk</option>
                            <option value="alat">Alat Pertanian</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="productPrice">Harga (Rp)</label>
                        <input type="number" id="productPrice" class="form-control" placeholder="Masukkan harga produk">
                    </div>
                    
                    <div class="form-group">
                        <label for="productStock">Stok</label>
                        <input type="number" id="productStock" class="form-control" placeholder="Masukkan jumlah stok">
                    </div>
                    
                    <div class="form-group">
                        <label for="productDescription">Deskripsi Produk</label>
                        <textarea id="productDescription" class="form-control" rows="3" placeholder="Masukkan deskripsi produk"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Foto Produk</label>
                        <div class="image-upload" id="imageUpload">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Klik untuk mengunggah foto produk</p>
                            <input type="file" id="productImage" accept="image/*" style="display: none;">
                            <img id="imagePreview" class="image-preview" src="" alt="Preview">
                        </div>
                        
                        <div class="camera-option">
                            <button type="button" class="btn btn-secondary" id="openCameraBtn">
                                <i class="fas fa-camera"></i> Ambil Foto dengan Kamera
                            </button>
                        </div>
                        
                        <div class="camera-container" id="cameraContainer">
                            <video id="cameraPreview" autoplay playsinline></video>
                            <div class="camera-controls">
                                <button type="button" class="btn btn-secondary" id="captureBtn">
                                    <i class="fas fa-camera"></i> Ambil Foto
                                </button>
                                <button type="button" class="btn btn-primary" id="closeCameraBtn">
                                    <i class="fas fa-times"></i> Tutup Kamera
                                </button>
                            </div>
                            <canvas id="cameraCanvas" style="display: none;"></canvas>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancelBtn">Batal</button>
                <button class="btn btn-primary" id="saveProductBtn">Simpan Produk</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let products = JSON.parse(localStorage.getItem('agriel_products')) || [];
        let salesData = JSON.parse(localStorage.getItem('agriel_sales')) || {
            totalSales: 0,
            monthlyRevenue: 0,
            bestSeller: '-',
            salesHistory: []
        };

        const productsTabBtn = document.getElementById('productsTabBtn');
        const salesTabBtn = document.getElementById('salesTabBtn');
        const dashboardTab = document.getElementById('dashboardTab');
        const productsTab = document.getElementById('productsTab');
        const salesTab = document.getElementById('salesTab');
        const dashboardContent = document.getElementById('dashboardContent');
        const productsContent = document.getElementById('productsContent');
        const salesContent = document.getElementById('salesContent');
        const addProductBtn = document.getElementById('addProductBtn');
        const addProductBtn2 = document.getElementById('addProductBtn2');
        const productModal = document.getElementById('productModal');
        const closeModal = document.querySelector('.close-modal');
        const cancelBtn = document.getElementById('cancelBtn');
        const saveProductBtn = document.getElementById('saveProductBtn');
        const imageUpload = document.getElementById('imageUpload');
        const productImage = document.getElementById('productImage');
        const imagePreview = document.getElementById('imagePreview');
        const openCameraBtn = document.getElementById('openCameraBtn');
        const cameraContainer = document.getElementById('cameraContainer');
        const cameraPreview = document.getElementById('cameraPreview');
        const captureBtn = document.getElementById('captureBtn');
        const closeCameraBtn = document.getElementById('closeCameraBtn');
        const cameraCanvas = document.getElementById('cameraCanvas');
        const productsTableBody = document.getElementById('productsTableBody');
        const allProductsTableBody = document.getElementById('allProductsTableBody');
        const totalProducts = document.getElementById('totalProducts');
        const monthlySales = document.getElementById('monthlySales');
        const totalRevenue = document.getElementById('totalRevenue');
        const totalSales = document.getElementById('totalSales');
        const monthlyRevenue = document.getElementById('monthlyRevenue');
        const bestSeller = document.getElementById('bestSeller');

        dashboardTab.addEventListener('click', () => switchTab('dashboard'));
        productsTab.addEventListener('click', () => switchTab('products'));
        salesTab.addEventListener('click', () => switchTab('sales'));
        productsTabBtn.addEventListener('click', () => switchTab('products'));
        salesTabBtn.addEventListener('click', () => switchTab('sales'));

        function switchTab(tabName) {
            dashboardTab.classList.remove('active');
            productsTab.classList.remove('active');
            salesTab.classList.remove('active');
            dashboardContent.classList.remove('active');
            productsContent.classList.remove('active');
            salesContent.classList.remove('active');
            
            if (tabName === 'dashboard') {
                dashboardTab.classList.add('active');
                dashboardContent.classList.add('active');
                updateDashboard();
            } else if (tabName === 'products') {
                productsTab.classList.add('active');
                productsContent.classList.add('active');
                updateProductsTable();
            } else if (tabName === 'sales') {
                salesTab.classList.add('active');
                salesContent.classList.add('active');
                updateSalesData();
                renderSalesChart();
            }
        }

        addProductBtn.addEventListener('click', openProductModal);
        addProductBtn2.addEventListener('click', openProductModal);
        
        function openProductModal() {
            productModal.style.display = 'flex';
            document.getElementById('productForm').reset();
            imagePreview.style.display = 'none';
            imageUpload.querySelector('p').textContent = 'Klik untuk mengunggah foto produk';
            cameraContainer.style.display = 'none';
        }
        
        const closeModalFunc = () => {
            productModal.style.display = 'none';
            stopCamera();
        };
        
        closeModal.addEventListener('click', closeModalFunc);
        cancelBtn.addEventListener('click', closeModalFunc);
        
        imageUpload.addEventListener('click', () => {
            productImage.click();
        });
        
        productImage.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    imageUpload.querySelector('p').textContent = 'Ganti foto produk';
                };
                reader.readAsDataURL(file);
            }
        });
        
        openCameraBtn.addEventListener('click', openCamera);
        closeCameraBtn.addEventListener('click', closeCamera);
        captureBtn.addEventListener('click', capturePhoto);
        
        function openCamera() {
            cameraContainer.style.display = 'flex';
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    cameraPreview.srcObject = stream;
                })
                .catch(err => {
                    console.error("Error accessing camera: ", err);
                    alert("Tidak dapat mengakses kamera. Pastikan Anda memberikan izin akses kamera.");
                });
        }
        
        function closeCamera() {
            cameraContainer.style.display = 'none';
            stopCamera();
        }
        
        function stopCamera() {
            if (cameraPreview.srcObject) {
                cameraPreview.srcObject.getTracks().forEach(track => track.stop());
            }
        }
        
        function capturePhoto() {
            const context = cameraCanvas.getContext('2d');
            cameraCanvas.width = cameraPreview.videoWidth;
            cameraCanvas.height = cameraPreview.videoHeight;
            context.drawImage(cameraPreview, 0, 0, cameraCanvas.width, cameraCanvas.height);
            
            imagePreview.src = cameraCanvas.toDataURL('image/png');
            imagePreview.style.display = 'block';
            imageUpload.querySelector('p').textContent = 'Foto telah diambil';
            
            closeCamera();
        }
        
        saveProductBtn.addEventListener('click', () => {
            const name = document.getElementById('productName').value;
            const category = document.getElementById('productCategory').value;
            const price = document.getElementById('productPrice').value;
            const stock = document.getElementById('productStock').value;
            const description = document.getElementById('productDescription').value;
            const image = imagePreview.src || '';
            
            if (!name || !category || !price || !stock) {
                alert('Harap isi semua field yang wajib diisi!');
                return;
            }
            
            const newProduct = {
                id: Date.now(),
                name,
                category,
                price: parseInt(price),
                stock: parseInt(stock),
                description,
                image,
                status: 'active',
                dateAdded: new Date().toISOString()
            };
            
            products.push(newProduct);
            localStorage.setItem('agriel_products', JSON.stringify(products));
            
            alert('Produk berhasil ditambahkan!');
            closeModalFunc();
            updateDashboard();
            updateProductsTable();
        });
        
        function updateDashboard() {
            totalProducts.textContent = products.length;
            
            const monthlySalesCount = products.reduce((total, product) => {
                return total + Math.floor(product.stock * 0.2); 
            }, 0);
            monthlySales.textContent = monthlySalesCount;
            
            const revenue = products.reduce((total, product) => {
                return total + (product.price * Math.floor(product.stock * 0.2));
            }, 0);
            totalRevenue.textContent = `Rp ${revenue.toLocaleString('id-ID')}`;
            
            updateProductsTable();
        }
        
        function updateProductsTable() {
            const recentProducts = products.slice(-3).reverse();
            updateTable(productsTableBody, recentProducts);
            
            updateTable(allProductsTableBody, products.slice().reverse());
        }
        
        function updateTable(tableBody, productsArray) {
            if (productsArray.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <p>Belum ada produk. Tambah produk pertama Anda!</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            tableBody.innerHTML = productsArray.map(product => `
                <tr>
                    <td>
                        ${product.image ? 
                            `<img src="${product.image}" class="product-image" alt="${product.name}">` : 
                            `<div class="product-image" style="background: #eee; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="color: #ccc;"></i>
                            </div>`
                        }
                    </td>
                    <td>${product.name}</td>
                    <td>${product.category}</td>
                    <td>Rp ${product.price.toLocaleString('id-ID')}</td>
                    <td>${product.stock}</td>
                    <td><span class="status status-active">Aktif</span></td>
                    <td>
                        <div class="action-buttons">
                            <div class="btn-action btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="btn-action btn-delete" title="Hapus" onclick="deleteProduct(${product.id})">
                                <i class="fas fa-trash"></i>
                            </div>
                        </div>
                    </td>
                </tr>
            `).join('');
        }
        
        window.deleteProduct = function(id) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                products = products.filter(product => product.id !== id);
                localStorage.setItem('agriel_products', JSON.stringify(products));
                updateDashboard();
                updateProductsTable();
            }
        };
        
        function updateSalesData() {
            totalSales.textContent = salesData.totalSales;
            monthlyRevenue.textContent = `Rp ${salesData.monthlyRevenue.toLocaleString('id-ID')}`;
            bestSeller.textContent = salesData.bestSeller;
        }
        
        function renderSalesChart() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            
            if (salesData.salesHistory.length === 0) {
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                salesData.salesHistory = months.map(month => ({
                    month,
                    sales: Math.floor(Math.random() * 100) + 10,
                    revenue: Math.floor(Math.random() * 1000000) + 100000
                }));
                localStorage.setItem('agriel_sales', JSON.stringify(salesData));
            }
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: salesData.salesHistory.map(item => item.month),
                    datasets: [{
                        label: 'Penjualan (kg)',
                        data: salesData.salesHistory.map(item => item.sales),
                        backgroundColor: 'rgba(46, 125, 50, 0.7)',
                        borderColor: 'rgba(46, 125, 50, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        
        window.addEventListener('click', (e) => {
            if (e.target === productModal) {
                closeModalFunc();
            }
        });
        
        updateDashboard();
        updateProductsTable();
    </script>
</body>
</html>