<?php
header("Content-Type: application/json; charset=utf-8");
require_once "sessao.php";
require_once "conexao.php";

if (!usuario_logado()) {
    http_response_code(401);
    echo json_encode(["ok" => false, "erro" => "Não logado"]);
    exit;
}

$url     = trim($_POST['url'] ?? '');
$secao   = trim($_POST['secao'] ?? '');
$privada = intval($_POST['privada'] ?? 0) === 1 ? 1 : 0;
$dono    = trim($_POST['dono'] ?? '');

if ($url === '' || $secao === '') {
    http_response_code(400);
    echo json_encode(["ok" => false, "erro" => "URL ou seção vazia"]);
    exit;
}

// Regra: se for privada, o dono tem que ser o próprio usuário logado (ou admin que declarou dono).
if ($privada === 1) {
    if ($dono === '') $dono = usuario_nome();
    if (!usuario_eh_admin() && $dono !== usuario_nome()) {
        http_response_code(403);
        echo json_encode(["ok" => false, "erro" => "Você só pode salvar privado para você mesmo."]);
        exit;
    }
} else {
    $dono = null;
}

$stmt = $conn->prepare("INSERT INTO videos (url, secao, privada, dono) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $url, $secao, $privada, $dono);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(["ok" => false, "erro" => "Falha ao inserir: " . $stmt->error]);
    exit;
}

echo json_encode(["ok" => true, "id" => $stmt->insert_id]);
$stmt->close();
$conn->close();
?>
