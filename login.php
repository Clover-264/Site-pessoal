<?php
require_once "sessao.php";
require_once "conexao.php";

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $stmt = $conn->prepare("SELECT id, nome, senha_hash, aprovado, admin FROM usuarios WHERE nome = ? LIMIT 1");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if (!$res) {
        $erro = "Usuário ou senha inválidos.";
    } elseif (!password_verify($senha, $res['senha_hash'])) {
        $erro = "Usuário ou senha inválidos.";
    } elseif (intval($res['aprovado']) !== 1) {
        $erro = "Sua conta ainda não foi aprovada pelo admin.";
    } else {
        $_SESSION['user_id']    = $res['id'];
        $_SESSION['user_nome']  = $res['nome'];
        $_SESSION['user_admin'] = intval($res['admin']) === 1;
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="icon" href="favicon.png" type="image/png">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth-box">
    <h1>Login</h1>
    <?php if ($erro): ?><p class="erro"><?= htmlspecialchars($erro) ?></p><?php endif; ?>
    <form method="post">
        <input type="text" name="nome" placeholder="Seu nome" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="cadastro.php">Criar conta</a></p>
</div>
</body>
</html>
