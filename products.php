<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$products = [
    [
        'id' => 1,
        'nama_produk' => 'Bibit Padi Unggul',
        'harga' => 25000,
        'stok' => 100,
        'deskripsi' => 'Bibit padi berkualitas tinggi dengan hasil panen maksimal, cocok untuk lahan basah',
        'kategori' => 'Bibit',
        'gambar' => 'https://images.unsplash.com/photo-1621357457397-8b0e2e5b0b5f?w=300&h=200&fit=crop&crop=center',
        'farmer_name' => 'Petani Budi'
    ],
    [
        'id' => 2,
        'nama_produk' => 'Pupuk Organik',
        'harga' => 15000,
        'stok' => 50,
        'deskripsi' => 'Pupuk alami ramah lingkungan untuk kesuburan tanah jangka panjang',
        'kategori' => 'Pupuk',
        'gambar' => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?w=300&h=200&fit=crop&crop=center',
        'farmer_name' => 'Petani Surya'
    ],
    [
        'id' => 3,
        'nama_produk' => 'Alat Semprot Pertanian',
        'harga' => 75000,
        'stok' => 10,
        'deskripsi' => 'Alat semprot praktis dan efisien untuk perawatan tanaman',
        'kategori' => 'Alat',
        'gambar' => 'https://images.unsplash.com/photo-1560493676-04071c5f467b?w=300&h=200&fit=crop&crop=center',
        'farmer_name' => 'Petani Joko'
    ]
];

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : count($products);
$limited_products = array_slice($products, 0, $limit);

echo json_encode([
    "success" => true,
    "data" => $limited_products,
    "total" => count($limited_products),
    "message" => "Data produk berhasil diambil"
]);
?>