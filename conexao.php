<?php
// ⚠️ NÃO mande header aqui — este arquivo é incluído por páginas HTML também.
// Cada arquivo PHP que RETORNA JSON já seta o header próprio.

$DB_HOST = "sql107.infinityfree.com";
$DB_USER = "if0_41764451";
$DB_PASS = "zIYNCLJMNBLoVJn";
$DB_NAME = "if0_41764451_galerasite";
$DB_PORT = 3306;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
    $conn->set_charset("utf8mb4");
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(["ok" => false, "erro" => "Erro de conexão: " . $e->getMessage()]);
    exit;
}
?>
