<?php
require_once "sessao.php";
require_once "conexao.php";
exigir_admin();

// Ações
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id   = intval($_POST['id'] ?? 0);
    $acao = $_POST['acao'] ?? '';
    if ($id > 0) {
        if ($acao === 'aprovar') {
            $conn->query("UPDATE usuarios SET aprovado = 1 WHERE id = $id");
        } elseif ($acao === 'negar') {
            $conn->query("DELETE FROM usuarios WHERE id = $id AND admin = 0");
        } elseif ($acao === 'promover') {
            $conn->query("UPDATE usuarios SET admin = 1, aprovado = 1 WHERE id = $id");
        } elseif ($acao === 'rebaixar') {
            $conn->query("UPDATE usuarios SET admin = 0 WHERE id = $id");
        }
    }
    header("Location: aprovar.php");
    exit;
}

$lista = $conn->query("SELECT id, nome, convidado_por, aprovado, admin, criado_em FROM usuarios ORDER BY aprovado ASC, criado_em DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Painel Admin</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Painel do Admin</h1>
<p><a href="index.php">← Voltar ao site</a> | <a href="logout.php">Sair</a></p>

<table class="admin-tabela">
<tr><th>Nome</th><th>Convidado por</th><th>Status</th><th>Admin</th><th>Criado</th><th>Ações</th></tr>
<?php while ($u = $lista->fetch_assoc()): ?>
<tr>
  <td><?= htmlspecialchars($u['nome']) ?></td>
  <td><?= htmlspecialchars($u['convidado_por'] ?? '-') ?></td>
  <td><?= $u['aprovado'] ? '✅ Aprovado' : '⏳ Pendente' ?></td>
  <td><?= $u['admin'] ? '👑' : '-' ?></td>
  <td><?= htmlspecialchars($u['criado_em']) ?></td>
  <td>
    <?php if (!$u['aprovado']): ?>
      <form method="post" style="display:inline">
        <input type="hidden" name="id" value="<?= $u['id'] ?>">
        <input type="hidden" name="acao" value="aprovar">
        <button>Aprovar</button>
      </form>
      <form method="post" style="display:inline">
        <input type="hidden" name="id" value="<?= $u['id'] ?>">
        <input type="hidden" name="acao" value="negar">
        <button>Negar</button>
      </form>
    <?php endif; ?>
    <?php if (!$u['admin']): ?>
      <form method="post" style="display:inline">
        <input type="hidden" name="id" value="<?= $u['id'] ?>">
        <input type="hidden" name="acao" value="promover">
        <button>Tornar admin</button>
      </form>
    <?php else: ?>
      <form method="post" style="display:inline">
        <input type="hidden" name="id" value="<?= $u['id'] ?>">
        <input type="hidden" name="acao" value="rebaixar">
        <button>Tirar admin</button>
      </form>
    <?php endif; ?>
  </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
