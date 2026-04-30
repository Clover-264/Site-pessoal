<?php
// Inicia sessão em TODAS as páginas que incluírem este arquivo
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function usuario_logado() {
    return !empty($_SESSION['user_id']);
}

function usuario_nome() {
    return $_SESSION['user_nome'] ?? null;
}

function usuario_eh_admin() {
    return !empty($_SESSION['user_admin']);
}

function exigir_login() {
    if (!usuario_logado()) {
        header("Location: login.php");
        exit;
    }
}

function exigir_admin() {
    exigir_login();
    if (!usuario_eh_admin()) {
        http_response_code(403);
        echo "Acesso negado.";
        exit;
    }
}
?>
