<?php
// app/views/visitas/atualizarData.php
require_once dirname(__DIR__, 3) . '/config/config.php';
require_once dirname(__DIR__, 3) . '/config/database.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$novaData = filter_input(INPUT_POST, 'nova_data', FILTER_SANITIZE_SPECIAL_CHARS);

if ($id && $novaData) {
   
    $stmt = $pdo->prepare("UPDATE visitas SET data_visita = :data WHERE id = :id");
    
    if ($stmt->execute([':data' => $novaData, ':id' => $id])) {
        // Envie um JSON válido
        header('Content-Type: application/json');
        echo json_encode(['status' => 'sucesso']);
        exit;
    }
}
http_response_code(500);
echo json_encode(['status' => 'erro']);