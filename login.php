<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    
    $_SESSION['user'] = [
        'id' => rand(1000, 9999),
        'nama' => 'User',
        'email' => $email,
        'role' => 'pembeli'
    ];
    
    echo json_encode(['success' => true, 'message' => 'Login berhasil!']);
    exit();
}
?>