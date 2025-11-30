<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'pembeli';
    
    if (empty($nama) || empty($email) || empty($password) || empty($role)) {
        echo json_encode(['success' => false, 'message' => 'Semua field harus diisi!']);
        exit();
    }
    
    $_SESSION['user'] = [
        'id' => rand(1000, 9999),
        'nama' => $nama,
        'email' => $email,
        'role' => $role
    ];
    
    echo json_encode(['success' => true, 'message' => 'Registrasi berhasil!']);
    exit();
}
?>