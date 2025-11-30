<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$min_price = $_GET['min_price'] ?? 0;
$max_price = $_GET['max_price'] ?? 999999999;
$sort = $_GET['sort'] ?? 'newest';

try {
    $sql = "SELECT p.*, u.nama as petani_nama, u.alamat as lokasi 
            FROM products p 
            JOIN users u ON p.id_farmer = u.id 
            WHERE 1=1";
    
    $params = [];

    if (!empty($search)) {
        $sql .= " AND (p.nama_produk LIKE ? OR p.deskripsi LIKE ?)";
        $search_term = "%$search%";
        $params[] = $search_term;
        $params[] = $search_term;
    }

    if (!empty($category)) {
        $sql .= " AND p.kategori = ?";
        $params[] = $category;
    }

    $sql .= " AND p.harga BETWEEN ? AND ?";
    $params[] = $min_price;
    $params[] = $max_price;

    // Sorting
    switch($sort) {
        case 'price_low':
            $sql .= " ORDER BY p.harga ASC";
            break;
        case 'price_high':
            $sql .= " ORDER BY p.harga DESC";
            break;
        case 'name':
            $sql .= " ORDER BY p.nama_produk ASC";
            break;
        default:
            $sql .= " ORDER BY p.created_at DESC";
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $products,
        "total" => count($products)
    ]);

} catch(PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ]);
}
?>