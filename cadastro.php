<?php
require_once "sessao.php";
require_once "conexao.php";

$erro = "";
$ok = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome    = trim($_POST['nome'] ?? '');
    $senha   = $_POST['senha'] ?? '';
    $senha2  = $_POST['senha2'] ?? '';
    $conv    = trim($_POST['convidado_por'] ?? '');

    if ($nome === '' || $senha === '' || $senha2 === '' || $conv === '') {
        $erro = "Preenche tudo, inclusive quem te convidou.";
    } elseif (strlen($nome) > 50) {
        $erro = "Nome muito longo.";
    } elseif ($senha !== $senha2) {
        $erro = "As senhas não batem.";
    } elseif (strlen($senha) < 4) {
        $erro = "Senha precisa ter pelo menos 4 caracteres.";
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, senha_hash, convidado_por, aprovado, admin) VALUES (?, ?, ?, 0, 0)");
        $stmt->bind_param("sss", $nome, $hash, $conv);
        if ($stmt->execute()) {
            $ok = "Cadastro enviado! Espera o admin aprovar você.";
        } else {
            if ($conn->errno === 1062) {
                $erro = "Esse nome já existe.";
            } else {
                $erro = "Erro: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<link rel="icon" href="favicon.png" type="image/png">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth-box">
    <h1>Cadastro</h1>
    <?php if ($erro): ?><p class="erro"><?= htmlspecialchars($erro) ?></p><?php endif; ?>
    <?php if ($ok): ?><p class="ok"><?= htmlspecialchars($ok) ?></p><?php endif; ?>
    <form method="post">
        <input type="text" name="nome" placeholder="Seu nome" required maxlength="50">
        <input type="password" name="senha" placeholder="Senha" required>
        <input type="password" name="senha2" placeholder="Confirmar senha" required>
        <input type="text" name="convidado_por" placeholder="Quem te convidou?" required maxlength="50">
        <button type="submit">Cadastrar</button>
    </form>
    <p><a href="login.php">Já tenho conta</a></p>
</div>
</body>
</html>
