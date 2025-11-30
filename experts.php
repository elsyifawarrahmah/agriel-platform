<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../config/database.php';

try {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT id, nama, email, foto, bidang, bio, alamat 
              FROM users 
              WHERE role = 'agronom' 
              ORDER BY nama";

    $stmt = $db->prepare($query);
    $stmt->execute();
    $experts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $experts,
        "total" => count($experts),
        "message" => "Experts loaded successfully"
    ]);

} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage(),
        "data" => []
    ]);
}
?>