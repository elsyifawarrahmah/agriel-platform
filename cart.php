<?php
session_start();

$productData = [
    1 => ['id' => 1, 'nama_produk' => 'Beras Organik Premium', 'harga' => 25000],
    2 => ['id' => 2, 'nama_produk' => 'Cabe Rawit Merah', 'harga' => 35000], 
    3 => ['id' => 3, 'nama_produk' => 'Jagung Manis Segar', 'harga' => 15000]
];

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as &$item) {
        if (isset($productData[$item['id']])) {
            $item['harga'] = $productData[$item['id']]['harga'];
            $item['nama_produk'] = $productData[$item['id']]['nama_produk'];
        }
    }
}

$subtotal = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $harga = isset($item['harga']) ? intval($item['harga']) : 0;
        $quantity = isset($item['quantity']) ? intval($item['quantity']) : 1;
        $subtotal += $harga * $quantity;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - AgriEl</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-seedling me-2"></i>AgriEl</a>
            <a class="nav-link" href="marketplace.php"><i class="fas fa-store me-1"></i>Pasar Digital</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</h2>
        
        <?php if(empty($_SESSION['cart'])): ?>
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Keranjang kosong</h4>
                <a href="marketplace.php" class="btn btn-primary">Belanja Sekarang</a>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-8">
                    <?php foreach($_SESSION['cart'] as $item): 
                        $harga = isset($item['harga']) ? intval($item['harga']) : 0;
                        $quantity = isset($item['quantity']) ? intval($item['quantity']) : 1;
                        $itemTotal = $harga * $quantity;
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <img src="<?= $item['gambar'] ?? 'https://via.placeholder.com/80x80/CCC/FFF?text=Produk' ?>" 
                                         class="img-fluid rounded" style="height: 80px; object-fit: cover;">
                                </div>
                                <div class="col-4">
                                    <h6 class="mb-1"><?= htmlspecialchars($item['nama_produk'] ?? 'Produk') ?></h6>
                                    <p class="text-success fw-bold mb-0">Rp <?= number_format($harga, 0, ',', '.') ?></p>
                                </div>
                                <div class="col-3">
                                    <div class="input-group input-group-sm">
                                        <button class="btn btn-outline-secondary" onclick="updateQuantity(<?= $item['id'] ?>, -1)">-</button>
                                        <input type="text" class="form-control text-center" value="<?= $quantity ?>" readonly style="max-width: 60px;">
                                        <button class="btn btn-outline-secondary" onclick="updateQuantity(<?= $item['id'] ?>, 1)">+</button>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <p class="fw-bold mb-0 text-success">Rp <?= number_format($itemTotal, 0, ',', '.') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h5 class="mb-0">Ringkasan Belanja</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <strong>Rp <?= number_format($subtotal, 0, ',', '.') ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Ongkos Kirim:</span>
                                <strong>Rp 10.000</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Total:</span>
                                <strong class="text-success fs-5">Rp <?= number_format($subtotal + 10000, 0, ',', '.') ?></strong>
                            </div>
                            
                            <button class="btn btn-success w-100" onclick="checkout()">
                                <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
    function updateQuantity(productId, change) {
        fetch('backend/api/cart.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({action: 'update', product_id: productId, quantity_change: change})
        }).then(r => r.json()).then(data => location.reload());
    }

    function checkout() {
        alert('Redirect ke halaman checkout...');
    }
    </script>
</body>
</html>