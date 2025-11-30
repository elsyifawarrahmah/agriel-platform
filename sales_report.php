<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$period = $_GET['period'] ?? 'month'; // week, month, year

try {
    // Sales report
    $sales_sql = "SELECT 
                    DATE(created_at) as date,
                    COUNT(*) as total_orders,
                    SUM(total) as total_revenue
                  FROM orders 
                  WHERE status = 'selesai' 
                  AND created_at >= DATE_SUB(NOW(), INTERVAL 1 $period)
                  GROUP BY DATE(created_at)
                  ORDER BY date";
    
    $stmt = $db->prepare($sales_sql);
    $stmt->execute();
    $sales_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Top products
    $products_sql = "SELECT 
                        p.nama_produk,
                        COUNT(o.id) as total_sold,
                        SUM(o.total) as revenue
                     FROM orders o
                     JOIN products p ON o.id_product = p.id
                     WHERE o.status = 'selesai'
                     GROUP BY p.id
                     ORDER BY total_sold DESC
                     LIMIT 10";
    
    $stmt = $db->prepare($products_sql);
    $stmt->execute();
    $top_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "sales_data" => $sales_data,
        "top_products" => $top_products
    ]);

} catch(PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ]);
}
?>