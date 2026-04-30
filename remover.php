<?php
header("Content-Type: application/json; charset=utf-8");
require_once "sessao.php";
require_once "conexao.php";

if (!usuario_logado()) {
    http_response_code(401);
    echo json_encode(["ok" => false, "erro" => "Não logado"]);
    exit;
}

$id = intval($_POST['id'] ?? 0);
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(["ok" => false, "erro" => "ID inválido"]);
    exit;
}

// Busca o vídeo pra checar permissão
$stmt = $conn->prepare("SELECT privada, dono FROM videos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$v = $stmt->get_result()->fetch_assoc();

if (!$v) {
    http_response_code(404);
    echo json_encode(["ok" => false, "erro" => "Não existe"]);
    exit;
}

// Admin remove qualquer. Se for privada, só o dono remove. Se for pública, qualquer logado pode.
if (!usuario_eh_admin()) {
    if (intval($v['privada']) === 1 && $v['dono'] !== usuario_nome()) {
        http_response_code(403);
        echo json_encode(["ok" => false, "erro" => "Sem permissão"]);
        exit;
    }
}

$stmt = $conn->prepare("DELETE FROM videos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["ok" => true]);
$conn->close();
?>
