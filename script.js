// ============ SEM MASONRY: layout Pinterest é puro CSS (column-count) ============
document.addEventListener("DOMContentLoaded", function () {
    carregarVideos();
});

// ============ DETECTORES DE LINK ============
function ehImagem(url) {
    return /\.(png|jpe?g|gif|webp|bmp|svg)(\?.*)?$/i.test(url);
}
function ehVideoDireto(url) {
    return /\.(mp4|webm|ogg|mov)(\?.*)?$/i.test(url);
}
function youtubeId(url) {
    try {
        var u = new URL(url);
        var host = u.hostname.replace(/^www\./, '');
        if (host === 'youtu.be') {
            var id = u.pathname.slice(1).split('/')[0];
            return /^[A-Za-z0-9_-]{6,}$/.test(id) ? id : null;
        }
        if (host.endsWith('youtube.com') || host === 'youtube-nocookie.com') {
            if (u.searchParams.get('v')) {
                var v = u.searchParams.get('v');
                return /^[A-Za-z0-9_-]{6,}$/.test(v) ? v : null;
            }
            var m = u.pathname.match(/^\/(?:shorts|embed|live|v)\/([A-Za-z0-9_-]{6,})/);
            if (m) return m[1];
        }
    } catch (e) {}
    var m2 = url.match(/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/|live\/|v\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/);
    return m2 ? m2[1] : null;
}
function ehYoutubeShort(url) {
    return /youtube\.com\/shorts\//i.test(url);
}
function instagramUrl(url) {
    var m = url.match(/instagram\.com\/(p|reel|tv)\/([A-Za-z0-9_-]+)/);
    return m ? ("https://www.instagram.com/" + m[1] + "/" + m[2] + "/embed") : null;
}
function tiktokId(url) {
    var m = url.match(/tiktok\.com\/.+\/video\/(\d+)/);
    return m ? m[1] : null;
}
function twitterStatus(url) {
    var m = url.match(/(?:twitter\.com|x\.com)\/([^\/]+)\/status\/(\d+)/);
    return m ? { user: m[1], id: m[2] } : null;
}
function vimeoId(url) {
    var m = url.match(/vimeo\.com\/(\d+)/);
    return m ? m[1] : null;
}

function criarMidia(url) {
    var yt = youtubeId(url);
    if (yt) {
        var f = document.createElement('iframe');
        f.src = "https://www.youtube.com/embed/" + yt;
        f.setAttribute('allow', "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture");
        f.setAttribute('allowfullscreen', 'true');
        f.setAttribute('frameborder', '0');
        // Shorts ficam verticais; vídeo normal fica 16:9
        f.className = ehYoutubeShort(url) ? "embed embed-alto" : "embed embed-yt";
        return f;
    }
    var insta = instagramUrl(url);
    if (insta) {
        var f = document.createElement('iframe');
        f.src = insta;
        f.setAttribute('allowfullscreen', 'true');
        f.setAttribute('frameborder', '0');
        f.className = "embed embed-alto";
        return f;
    }
    var tk = tiktokId(url);
    if (tk) {
        var f = document.createElement('iframe');
        f.src = "https://www.tiktok.com/embed/v2/" + tk;
        f.setAttribute('allowfullscreen', 'true');
        f.setAttribute('frameborder', '0');
        f.className = "embed embed-alto";
        return f;
    }
    var tw = twitterStatus(url);
    if (tw) {
        var wrap = document.createElement('blockquote');
        wrap.className = "twitter-tweet";
        var a = document.createElement('a');
        a.href = "https://twitter.com/" + tw.user + "/status/" + tw.id;
        a.innerText = a.href;
        wrap.appendChild(a);
        if (!document.getElementById('tw-widget')) {
            var s = document.createElement('script');
            s.id = 'tw-widget';
            s.src = 'https://platform.twitter.com/widgets.js';
            s.async = true;
            document.body.appendChild(s);
        } else if (window.twttr && window.twttr.widgets) {
            setTimeout(function () { window.twttr.widgets.load(); }, 50);
        }
        return wrap;
    }
    var vm = vimeoId(url);
    if (vm) {
        var f = document.createElement('iframe');
        f.src = "https://player.vimeo.com/video/" + vm;
        f.setAttribute('allowfullscreen', 'true');
        f.setAttribute('frameborder', '0');
        f.className = "embed embed-yt";
        return f;
    }
    if (ehImagem(url)) {
        var img = document.createElement('img');
        img.src = url;
        img.alt = "mídia";
        img.loading = "lazy";
        return img;
    }
    if (ehVideoDireto(url)) {
        var v = document.createElement('video');
        v.src = url;
        v.controls = true;
        v.preload = "metadata";
        return v;
    }
    var a = document.createElement('a');
    a.href = url;
    a.target = "_blank";
    a.rel = "noopener";
    a.innerText = url;
    a.className = "link-fallback";
    return a;
}

// ADICIONA UM ITEM JÁ NA TELA (sem Masonry — basta colocar no DOM, o CSS resolve)
function adicionarVideo(url, gridId, id) {
    var grid = document.getElementById(gridId);
    if (!grid) return;

    var item = document.createElement('div');
    item.className = 'item';

    var midia = criarMidia(url);
    item.appendChild(midia);

    var btn = document.createElement('button');
    btn.innerText = "X";
    btn.title = "Remover";
    btn.onclick = function () { removerVideo(id, item, gridId); };
    item.appendChild(btn);

    grid.appendChild(item);
}

// BOTÃO ADICIONAR
function addVideo(quem, privada, donoOverride) {
    var inputURL   = document.getElementById(quem + "URL")   || document.getElementById(quem + "videoURL");
    var inputSecao = document.getElementById(quem + "secao");

    if (!inputURL || !inputSecao) {
        alert("Erro interno: não achei os campos de '" + quem + "'.");
        return;
    }

    var url = inputURL.value.trim();
    var secao = inputSecao.value;
    if (!url) { alert("Cole um link primeiro!"); return; }

    var body = "url=" + encodeURIComponent(url) +
               "&secao=" + encodeURIComponent(secao) +
               "&privada=" + (privada ? 1 : 0);
    if (privada && donoOverride) body += "&dono=" + encodeURIComponent(donoOverride);

    fetch("salvar.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: body
    })
    .then(function (res) { return res.text().then(function (t) { return { status: res.status, texto: t }; }); })
    .then(function (resp) {
        var data;
        try { data = JSON.parse(resp.texto); }
        catch (e) {
            console.error("salvar.php retornou não-JSON:", resp.texto);
            alert("Servidor não retornou JSON:\n" + resp.texto.substring(0,300));
            return;
        }
        if (!data.ok) { alert("Não salvou: " + (data.erro || "erro")); return; }
        adicionarVideo(url, secao, data.id);
        inputURL.value = "";
    })
    .catch(function (err) { alert("Erro de rede: " + err); });
}

// CARREGAR TUDO
function carregarVideos() {
    fetch("carregar.php")
        .then(function (r) { return r.text(); })
        .then(function (t) {
            var videos;
            try { videos = JSON.parse(t); } catch (e) { console.error("carregar.php:", t); return; }
            if (!Array.isArray(videos)) return;
            videos.forEach(function (v) { adicionarVideo(v.url, v.secao, v.id); });
        })
        .catch(function (err) { console.error("Erro carregar:", err); });
}

// REMOVER
function removerVideo(id, item, gridId) {
    if (!confirm("Remover essa mídia?")) return;
    fetch("remover.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + encodeURIComponent(id)
    })
    .then(function (r) { return r.json(); })
    .then(function (data) {
        if (!data.ok) { alert("Erro: " + (data.erro || "")); return; }
        if (item && item.parentNode) item.parentNode.removeChild(item);
    })
    .catch(function (err) { alert("Erro: " + err); });
}
