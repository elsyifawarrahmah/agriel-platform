<?php
session_start();

// Jika cart kosong, redirect ke cart
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

$productData = [
    1 => ['id' => 1, 'nama_produk' => 'Beras Organik Premium', 'harga' => 25000],
    2 => ['id' => 2, 'nama_produk' => 'Cabe Rawit Merah', 'harga' => 35000], 
    3 => ['id' => 3, 'nama_produk' => 'Jagung Manis Segar', 'harga' => 15000]
];

// Hitung total
$subtotal = 0;
$items = [];
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        if (isset($productData[$item['id']])) {
            $harga = $productData[$item['id']]['harga'];
            $quantity = isset($item['quantity']) ? intval($item['quantity']) : 1;
            $itemTotal = $harga * $quantity;
            $subtotal += $itemTotal;
            
            $items[] = [
                'nama' => $productData[$item['id']]['nama_produk'],
                'harga' => $harga,
                'quantity' => $quantity,
                'total' => $itemTotal
            ];
        }
    }
}
$ongkir = 10000;
$total = $subtotal + $ongkir;

// Proses pembayaran
if ($_POST['action'] ?? '' == 'bayar') {
    // Simpan data pesanan
    $order_id = 'AGR' . date('YmdHis');
    $_SESSION['last_order'] = [
        'order_id' => $order_id,
        'items' => $items,
        'total' => $total,
        'waktu' => date('Y-m-d H:i:s')
    ];
    
    // Kosongkan cart
    $_SESSION['cart'] = [];
    
    // Redirect ke halaman sukses
    header('Location: order_success.php?order_id=' . $order_id);
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - AgriEl</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .header-checkout {
            background: linear-gradient(135deg, #2e7d32, #4caf50);
            color: white;
        }
        .payment-card {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            transition: all 0.3s;
            cursor: pointer;
        }
        .payment-card:hover {
            border-color: #2e7d32;
            transform: translateY(-2px);
        }
        .payment-card.selected {
            border-color: #2e7d32;
            background-color: #e8f5e9;
        }
        .btn-bayar {
            background: linear-gradient(135deg, #2e7d32, #4caf50);
            border: none;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
        }
        .btn-bayar:hover {
            background: linear-gradient(135deg, #1b5e20, #2e7d32);
            transform: translateY(-2px);
        }
        .order-summary {
            position: sticky;
            top: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark header-checkout">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-seedling me-2"></i><strong>AgriEl</strong>
            </a>
            <div class="navbar-nav">
                <a class="nav-link" href="cart.php">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Keranjang
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <!-- Form Checkout -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><i class="fas fa-truck me-2"></i>Informasi Pengiriman</h4>
                    </div>
                    <div class="card-body">
                        <form id="checkoutForm" method="POST">
                            <input type="hidden" name="action" value="bayar">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" name="nama" value="Ahmad Wijaya" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control" name="email" value="ahmad@example.com" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon *</label>
                                <input type="tel" class="form-control" name="telepon" value="08123456789" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap *</label>
                                <textarea class="form-control" name="alamat" rows="3" required>Jl. Merdeka No. 123, Jakarta Pusat</textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota *</label>
                                    <input type="text" class="form-control" name="kota" value="Jakarta Pusat" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode Pos *</label>
                                    <input type="text" class="form-control" name="kodepos" value="10110" required>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i>Metode Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="payment-card p-3 selected" onclick="selectPayment('transfer')">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" value="transfer" checked>
                                        <label class="form-check-label fw-bold">Transfer Bank</label>
                                    </div>
                                    <small class="text-muted">BCA, BNI, Mandiri, BRI</small>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="payment-card p-3" onclick="selectPayment('ewallet')">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" value="ewallet">
                                        <label class="form-check-label fw-bold">E-Wallet</label>
                                    </div>
                                    <small class="text-muted">GoPay, OVO, Dana, LinkAja</small>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="payment-card p-3" onclick="selectPayment('cod')">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" value="cod">
                                        <label class="form-check-label fw-bold">COD</label>
                                    </div>
                                    <small class="text-muted">Bayar di Tempat</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="col-md-4">
                <div class="card shadow-sm order-summary">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <!-- Daftar Produk -->
                        <?php foreach($items as $item): ?>
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                            <div>
                                <h6 class="mb-1"><?= $item['nama'] ?></h6>
                                <small class="text-muted"><?= $item['quantity'] ?> x Rp <?= number_format($item['harga'], 0, ',', '.') ?></small>
                            </div>
                            <span class="fw-bold text-success">Rp <?= number_format($item['total'], 0, ',', '.') ?></span>
                        </div>
                        <?php endforeach; ?>

                        <!-- Total -->
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <strong>Rp <?= number_format($subtotal, 0, ',', '.') ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Ongkos Kirim:</span>
                                <strong>Rp <?= number_format($ongkir, 0, ',', '.') ?></strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total:</span>
                                <span class="fw-bold fs-5 text-success">Rp <?= number_format($total, 0, ',', '.') ?></span>
                            </div>
                        </div>

                        <!-- Tombol Bayar -->
                        <button type="submit" form="checkoutForm" class="btn btn-bayar w-100 mt-4">
                            <i class="fas fa-lock me-2"></i>BAYAR SEKARANG
                        </button>
                        
                        <small class="text-muted d-block mt-2 text-center">
                            <i class="fas fa-shield-alt me-1"></i>Pembayaran aman dan terenkripsi
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectPayment(method) {
            document.querySelectorAll('.payment-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            event.currentTarget.classList.add('selected');
            
            document.querySelector(`input[value="${method}"]`).checked = true;
        }

        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let valid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!valid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        });
    </script>
</body>
</html>