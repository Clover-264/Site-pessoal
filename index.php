<?php
require_once "sessao.php";
exigir_login();
$nome_logado = usuario_nome();
$eh_admin    = usuario_eh_admin();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site para salvar coisas</title>
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="topbar">
    <span>Olá, <strong><?= htmlspecialchars($nome_logado) ?></strong>!</span>
    <?php if ($eh_admin): ?>
        <a href="aprovar.php" class="btn-admin">👑 Painel Admin</a>
    <?php endif; ?>
    <a href="logout.php" class="btn-sair">Sair</a>
</div>

<h1 class="arco-iris">Site fodástico para salvar mídias fodásticas escolhidas a dedo de maneira fodástica.com</h1>

<h2>Membros:</h2>
<ul class="tamanho">
    <li><a href="#clover">Clover</a></li>
    <li><a href="#portelo">Portelo</a></li>
</ul>

<!-- ============ CLOVER ============ -->
<hr>
<h1 id="clover">SESSÃO: CLOVER</h1>

<h2>Clover sumário:</h2>
<ul class="tamanho">
    <li><a href="#clovervdmeme">Videos Memes</a></li>
    <li><a href="#clovervdreflex">Reflexivos</a></li>
    <li><a href="#clovereditsmusicais">Edits e Musicais</a></li>
    <li><a href="#clovermusicas">Músicas</a></li>
    <li><a href="#cloverinformativos">Informátivos</a></li>
    <li><a href="#cloverimgngif">Imagens e gifs</a></li>
    <li><a href="#cloverftsperfil">Fotos de perfil</a></li>
</ul>

<div class="form-add">
    <input type="text" id="clovervideoURL" placeholder="Cole link (YouTube, Insta, TikTok, Twitter, catbox...)">
    <select id="cloversecao">
        <option value="clovermemes">Clover: Memes</option>
        <option value="cloverreflexivos">Clover: Reflexivos</option>
        <option value="cloveredits">Clover: Edits/Musicais</option>
        <option value="clovermusics">Clover: Músicas</option>
        <option value="cloverinfo">Clover: Informátivos</option>
        <option value="cloverimagensgifs">Clover: Imagens/Gifs</option>
        <option value="cloverfotosperfil">Clover: Fotos de perfil</option>
    </select>
    <button onclick="addVideo('clover', false)">Adicionar público</button>
</div>

<h2 id="clovervdmeme"><strong>Clover: VideosMemes</strong></h2>
<div id="clovermemes" class="grid"></div>

<hr>
<h2 id="clovervdreflex"><strong>Clover: Reflexivos</strong></h2>
<div id="cloverreflexivos" class="grid"></div>

<hr>
<h2 id="clovereditsmusicais"><strong>Clover: Edits/musicais</strong></h2>
<div id="cloveredits" class="grid"></div>

<hr>
<h2 id="clovermusicas"><strong>Clover: Músicas</strong></h2>
<div id="clovermusics" class="grid"></div>

<hr>
<h2 id="cloverinformativos"><strong>Clover: Informátivos</strong></h2>
<div id="cloverinfo" class="grid"></div>

<hr>
<h2 id="cloverimgngif"><strong>Clover: Imagens/gifs</strong></h2>
<div id="cloverimagensgifs" class="grid"></div>

<hr>
<h2 id="cloverftsperfil"><strong>Clover: Fotos de perfil</strong></h2>
<div id="cloverfotosperfil" class="grid"></div>

<!-- Sessão PRIVADA do Clover: só Clover e admin veem -->
<?php if ($eh_admin || $nome_logado === 'Clover'): ?>
<hr>
<h1 class="privada">🔒 SESSÃO PRIVADA: CLOVER</h1>
<div class="form-add">
    <input type="text" id="cloverprivURL" placeholder="Link privado (só você vê)">
    <select id="cloverprivsecao">
        <option value="cloverpriv_geral">Clover Privado: Geral</option>
        <option value="cloverpriv_videos">Clover Privado: Vídeos</option>
        <option value="cloverpriv_imagens">Clover Privado: Imagens</option>
    </select>
    <button onclick="addVideo('cloverpriv', true, 'Clover')">Adicionar privado</button>
</div>
<h2><strong>Privado Clover: Geral</strong></h2>
<div id="cloverpriv_geral" class="grid"></div>
<h2><strong>Privado Clover: Vídeos</strong></h2>
<div id="cloverpriv_videos" class="grid"></div>
<h2><strong>Privado Clover: Imagens</strong></h2>
<div id="cloverpriv_imagens" class="grid"></div>
<?php endif; ?>

<!-- ============ PORTELO ============ -->
<hr>
<h1 id="portelo">SESSÃO: PORTELO</h1>

<h2>Portelo sumário:</h2>
<ul class="tamanho">
    <li><a href="#portelovdmeme">Videos Memes</a></li>
    <li><a href="#portelovdreflex">Reflexivos</a></li>
    <li><a href="#porteloeditsmusicais">Edits e Musicais</a></li>
    <li><a href="#porteloimgngif">Imagens e gifs</a></li>
    <li><a href="#porteloftsperfil">Fotos de perfil</a></li>
    <li><a href="#portelomaisdezo">+18</a></li>
</ul>

<div class="form-add">
    <input type="text" id="portelovideoURL" placeholder="Cole link (YouTube, Insta, TikTok, Twitter, catbox...)">
    <select id="portelosecao">
        <option value="portelomemes">Portelo: Memes</option>
        <option value="porteloreflexivos">Portelo: Reflexivos</option>
        <option value="porteloedits">Portelo: Edits/Musicais</option>
        <option value="porteloimagensgifs">Portelo: Imagens/Gifs</option>
        <option value="portelofotosperfil">Portelo: Fotos de perfil</option>
        <option value="portelomaisdezoito">Portelo: +18</option>
    </select>
    <button onclick="addVideo('portelo', false)">Adicionar público</button>
</div>

<h2 id="portelovdmeme"><strong>Portelo: VideosMemes</strong></h2>
<div id="portelomemes" class="grid"></div>

<hr>
<h2 id="portelovdreflex"><strong>Portelo: Reflexivos</strong></h2>
<div id="porteloreflexivos" class="grid"></div>

<hr>
<h2 id="porteloeditsmusicais"><strong>Portelo: Edits/musicais</strong></h2>
<div id="porteloedits" class="grid"></div>

<hr>
<h2 id="porteloimgngif"><strong>Portelo: Imagens/gifs</strong></h2>
<div id="porteloimagensgifs" class="grid"></div>

<hr>
<h2 id="porteloftsperfil"><strong>Portelo: Fotos de perfil</strong></h2>
<div id="portelofotosperfil" class="grid"></div>

<hr>
<h2 id="portelomaisdezo"><strong>Portelo: +18</strong></h2>
<div id="portelomaisdezoito" class="grid"></div>

<!-- Sessão PRIVADA do Portelo -->
<?php if ($eh_admin || $nome_logado === 'Portelo'): ?>
<hr>
<h1 class="privada">🔒 SESSÃO PRIVADA: PORTELO</h1>
<div class="form-add">
    <input type="text" id="porteloprivURL" placeholder="Link privado (só você vê, viado)">
    <select id="porteloprivsecao">
        <option value="portelopriv_geral">Portelo Privado: Geral</option>
        <option value="portelopriv_videos">Portelo Privado: Vídeos</option>
        <option value="portelopriv_imagens">Portelo Privado: Imagens</option>
    </select>
    <button onclick="addVideo('portelopriv', true, 'Portelo')">Adicionar privado</button>
</div>
<h2><strong>Privado Portelo: Geral</strong></h2>
<div id="portelopriv_geral" class="grid"></div>
<h2><strong>Privado Portelo: Vídeos</strong></h2>
<div id="portelopriv_videos" class="grid"></div>
<h2><strong>Privado Portelo: Imagens</strong></h2>
<div id="portelopriv_imagens" class="grid"></div>
<?php endif; ?>

<!-- Sem Masonry, sem imagesLoaded: layout Pinterest é puro CSS agora -->
<script src="script.js"></script>
</body>
</html>
