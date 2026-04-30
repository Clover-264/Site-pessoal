<?php
header("Content-Type: application/json; charset=utf-8");
require_once "sessao.php";
require_once "conexao.php";

if (!usuario_logado()) {
    http_response_code(401);
    echo json_encode(["erro" => "nao logado"]);
    exit;
}

$nome  = usuario_nome();
$admin = usuario_eh_admin() ? 1 : 0;

// Admin vê tudo. Usuário comum: vê todas as públicas + as privadas dele.
if ($admin) {
    $res = $conn->query("SELECT id, url, secao, privada, dono FROM videos ORDER BY id ASC");
} else {
    $stmt = $conn->prepare("
        SELECT id, url, secao, privada, dono FROM videos
        WHERE privada = 0
           OR (privada = 1 AND dono = ?)
        ORDER BY id ASC
    ");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $res = $stmt->get_result();
}

$videos = [];
while ($row = $res->fetch_assoc()) {
    $videos[] = $row;
}
echo json_encode($videos);
$conn->close();
?>
