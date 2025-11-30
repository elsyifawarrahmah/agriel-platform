<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        // Get consultations
        $query = "SELECT c.*, u1.nama as user_name, u2.nama as expert_name 
                 FROM consultations c 
                 LEFT JOIN users u1 ON c.id_user = u1.id 
                 LEFT JOIN users u2 ON c.id_expert = u2.id 
                 ORDER BY c.created_at DESC 
                 LIMIT 10";
        
        $stmt = $db->prepare($query);
        $stmt->execute();
        $consultations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode([
            "success" => true,
            "data" => $consultations
        ]);
        break;
        
    case 'POST':
        // CREATE new consultation
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->id_user) && !empty($data->pertanyaan)) {
            $query = "INSERT INTO consultations SET id_user=:id_user, id_expert=:id_expert, pertanyaan=:pertanyaan";
            $stmt = $db->prepare($query);
            
            $stmt->bindParam(":id_user", $data->id_user);
            $stmt->bindParam(":id_expert", $data->id_expert);
            $stmt->bindParam(":pertanyaan", $data->pertanyaan);
            
            if($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Pertanyaan berhasil dikirim"]);
            } else {
                echo json_encode(["success" => false, "message" => "Gagal mengirim pertanyaan"]);
            }
        }
        break;
        
    case 'PUT':
        // UPDATE consultation (answer)
        parse_str(file_get_contents("php://input"), $put_vars);
        $data = json_decode(array_keys($put_vars)[0]);
        
        if(!empty($data->id) && !empty($data->jawaban)) {
            $query = "UPDATE consultations SET jawaban=:jawaban, status='answered', answered_at=NOW() WHERE id=:id";
            $stmt = $db->prepare($query);
            
            $stmt->bindParam(":id", $data->id);
            $stmt->bindParam(":jawaban", $data->jawaban);
            
            if($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Jawaban berhasil dikirim"]);
            } else {
                echo json_encode(["success" => false, "message" => "Gagal mengirim jawaban"]);
            }
        }
        break;
}
?>