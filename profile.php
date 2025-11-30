<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Profil - AgriEl</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-seedling me-2"></i>AgriEl</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="marketplace.php">Pasar</a>
                <a class="nav-link" href="cart.php">Keranjang</a>
                <a class="nav-link active" href="profile.php">Profil</a>
                <a class="nav-link" href="backend/auth/logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-user me-2"></i>Profil Saya</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px; font-size: 1.5rem;">
                            <i class="fas fa-user"></i>
                        </div>
                        <h4 class="mt-3"><?php echo htmlspecialchars($user['nama']); ?></h4>
                        <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
                        <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                        <a href="marketplace.php" class="btn btn-success">
                            <i class="fas fa-store me-2"></i>Ke Pasar Digital
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white mt-5 py-3">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 AgriEl</p>
        </div>
    </footer>
</body>
</html>