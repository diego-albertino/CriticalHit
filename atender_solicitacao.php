<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: index.php");
    exit();
}

include "src/config/db_connect.php";

if (!isset($_GET['id_solicitacao']) || !is_numeric($_GET['id_solicitacao'])) {
    header("Location: solicitacoes.php");
    exit();
}

$idSolicitacao = (int)$_GET['id_solicitacao'];

$stmt = $conn->prepare("
    SELECT s.titulo_solicitado, s.desc_solicitado, u.nome AS nome_usuario
    FROM solicitacao_jogo s
    JOIN usuario u ON u.id = s.id_usuario
    WHERE s.id_solicitacao = ?
    LIMIT 1
");
$stmt->bind_param("i", $idSolicitacao);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: solicitacoes.php");
    exit();
}

$solicitacao = $result->fetch_assoc();

$nomeUsuario = $_SESSION['username'] ?? 'Usuário';
$isAdmin = true;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Atender Solicitação</title>
  <link rel="icon" href="assets/pictures/favicon.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="assets/css/jogo.css" />
  <link rel="stylesheet" href="assets/css/modal.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    .solicitacao-box {
      border: 2px solid #fe5655;
      border-radius: 8px;
      padding: 1.5rem;
      max-width: 600px;
      margin: 2rem auto;
      background-color: #fff;
    }
    .select-incluir-jogo {
      max-width: 600px;
      margin: 1rem auto 1rem;
    }
    .detalhes-jogo {
      max-width: 600px;
      margin: 0 auto 2rem;
      padding: 1rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #fff;
    }
    .btn-acoes {
      max-width: 600px;
      margin: 0 auto 3rem;
      display: flex;
      gap: 1rem;
      justify-content: center;
    }
    .btn-incluir {
      background-color: #fe5655;
      color: white;
      border: none;
    }
    .btn-incluir:hover {
      background-color: white;
      color: #fe5655;
      border: 1px solid #fe5655;
    }
  </style>
</head>
<body>
  <div id="navbar-container"></div>

  <div class="container">
    <h2 class="text-center mt-4 mb-4">Atender Solicitação</h2>

    <div class="solicitacao-box shadow-sm">
      <p><strong>Usuário:</strong> <?= htmlspecialchars($solicitacao['nome_usuario']) ?></p>
      <p><strong>Título:</strong> <?= htmlspecialchars($solicitacao['titulo_solicitado']) ?></p>
      <p><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($solicitacao['desc_solicitado'])) ?></p>
    </div>

    <div class="select-incluir-jogo">
      <label for="select-jogo" class="form-label">Incluir jogo</label>
      <input type="text" id="input-busca-jogo" class="form-control" placeholder="Digite o nome do jogo para buscar" />
      <select id="select-jogo" class="form-select mt-2" size="6" style="display:none;"></select>
    </div>

    <div class="detalhes-jogo" id="detalhes-jogo" style="display:none;"></div>

    <div class="btn-acoes">
      <button type="button" class="btn btn-incluir" disabled id="btn-incluir">Incluir Jogo</button>
      <button type="button" class="btn btn-secondary" id="btn-excluir">Excluir solicitação</button>
    </div>
  </div>

  <div id="footer-container" class="mt-5"></div>

  <script>
    const nomeUsuario = <?= json_encode($nomeUsuario) ?>;
    const isAdmin = <?= $isAdmin ? 'true' : 'false' ?>;
    const idSolicitacao = <?= json_encode($idSolicitacao) ?>;

    document.addEventListener("DOMContentLoaded", () => {
      
      fetch("src/templates/navbar.html")
        .then(res => res.text())
        .then(html => {
          document.getElementById("navbar-container").innerHTML = html;

          const loginLink = document.getElementById("login-link");
          if (loginLink) {
            loginLink.innerHTML = '';
            loginLink.style.position = "relative";

            const toggle = document.createElement("span");
            toggle.id = "userMenuToggle";
            toggle.className = "d-flex align-items-center text-dark";
            toggle.style.cssText = "max-width: 150px; cursor: pointer; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;";
            toggle.innerHTML = `<i class="bi bi-person-fill me-2"></i>${nomeUsuario}`;

            const dropdown = document.createElement("div");
            dropdown.id = "userDropdown";
            dropdown.className = "position-absolute bg-white border rounded shadow-sm";
            dropdown.style.cssText = "min-width:150px;left:0;top:100%;display:none;z-index:1050;";
            dropdown.innerHTML = `
              <a href="meu_perfil.php" class="d-block px-3 py-2 text-dark text-decoration-none">Meu perfil</a>
              ${isAdmin
                ? '<a href="solicitacoes.php" class="d-block px-3 py-2 text-dark text-decoration-none">Solicitações de jogos</a>'
                : '<a href="solicitar_jogo.php" class="d-block px-3 py-2 text-dark text-decoration-none">Solicitar um jogo</a>'}
              <hr class="my-1"/>
              <a href="src/actions/logout.php" class="d-block px-3 py-2 text-danger text-decoration-none">Sair</a>
            `;

            loginLink.appendChild(toggle);
            loginLink.appendChild(dropdown);

            toggle.addEventListener("click", e => {
              e.stopPropagation();
              dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            });

            window.addEventListener("click", e => {
              if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = "none";
              }
            });
          }
        });

      
      fetch("src/templates/footer.html")
        .then(res => res.text())
        .then(data => {
          document.getElementById("footer-container").innerHTML = data;
        });

      const inputBusca = document.getElementById('input-busca-jogo');
      const selectJogo = document.getElementById('select-jogo');
      const detalhesContainer = document.getElementById('detalhes-jogo');
      const btnIncluir = document.getElementById('btn-incluir');
      const btnExcluir = document.getElementById('btn-excluir');

      let jogosCache = [];

      function debounce(func, wait) {
        let timeout;
        return function(...args) {
          clearTimeout(timeout);
          timeout = setTimeout(() => func.apply(this, args), wait);
        };
      }

      
      const buscarJogos = debounce(() => {
        const q = inputBusca.value.trim();
        if (q.length < 3) {
          selectJogo.style.display = 'none';
          detalhesContainer.style.display = 'none';
          btnIncluir.disabled = true;
          selectJogo.innerHTML = '';
          return;
        }

        selectJogo.style.display = 'block';
        selectJogo.innerHTML = '<option>Carregando...</option>';
        btnIncluir.disabled = true;
        detalhesContainer.style.display = 'none';

        fetch(`src/actions/API_igdb/buscar-jogos-igdb.php?q=${encodeURIComponent(q)}`)
          .then(res => res.json())
          .then(data => {
            jogosCache = data;
            if (data.length === 0) {
              selectJogo.innerHTML = '<option>Nenhum jogo encontrado</option>';
              btnIncluir.disabled = true;
            } else {
              selectJogo.innerHTML = '';
              data.forEach(jogo => {
                const option = document.createElement('option');
                option.value = jogo.id;
                option.textContent = jogo.name;
                selectJogo.appendChild(option);
              });
            }
          })
          .catch(() => {
            selectJogo.innerHTML = '<option>Erro na busca</option>';
            btnIncluir.disabled = true;
          });
      }, 400);

      inputBusca.addEventListener('input', buscarJogos);

      
      selectJogo.addEventListener('change', () => {
        const selectedId = parseInt(selectJogo.value);
        if (!selectedId) {
          detalhesContainer.style.display = 'none';
          btnIncluir.disabled = true;
          detalhesContainer.innerHTML = '';
          return;
        }

       
        fetch(`src/actions/API_igdb/detalhe_jogo_igdb.php?id=${selectedId}`)
          .then(res => res.json())
          .then(data => {
            if (data.length === 0) {
              detalhesContainer.style.display = 'none';
              btnIncluir.disabled = true;
              detalhesContainer.innerHTML = '';
              return;
            }
            const jogo = data[0];

            let coverUrl = '';
            if (jogo.cover && jogo.cover.url) {
              
              coverUrl = 'https:' + jogo.cover.url.replace('t_thumb', 't_cover_big');
            }

            let plataformas = '';
            if (jogo.platforms && jogo.platforms.length > 0) {
              plataformas = jogo.platforms.map(p => p.name).join(', ');
            }

            detalhesContainer.style.display = 'block';
            detalhesContainer.innerHTML = `
              <h5>${jogo.name}</h5>
              ${coverUrl ? `<img src="${coverUrl}" alt="Capa do jogo ${jogo.name}" style="width: 150px; border-radius: 8px;"/>` : ''}
              <p><strong>ID:</strong> ${jogo.id}</p>
              <p><strong>Descrição:</strong> ${jogo.summary || 'Sem descrição.'}</p>
              ${plataformas ? `<p><strong>Plataformas:</strong> ${plataformas}</p>` : ''}
            `;
            btnIncluir.disabled = false;
          })
          .catch(() => {
            detalhesContainer.style.display = 'none';
            btnIncluir.disabled = true;
            detalhesContainer.innerHTML = '';
          });
      });

      btnExcluir.addEventListener('click', () => {
        if (!confirm('Deseja realmente excluir esta solicitação?')) return;

        fetch('src/actions/solicitacao_jogo/excluir_solicitacao.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          body: `id_solicitacao=${encodeURIComponent(idSolicitacao)}`
        })
        .then(res => res.json())
        .then(data => {
          if(data.success) {
            alert('Solicitação excluída com sucesso.');
            window.location.href = 'solicitacoes.php';
          } else {
            alert('Erro ao excluir solicitação.');
          }
        })
        .catch(() => alert('Erro na comunicação com o servidor.'));
      });

      btnIncluir.addEventListener('click', () => {
        const selectedId = parseInt(selectJogo.value);
        if (!selectedId) {
          alert('Selecione um jogo válido para incluir.');
          return;
        }
        
        const jogoSelecionado = jogosCache.find(j => j.id === selectedId);
        if (!jogoSelecionado) {
          alert('Jogo não encontrado no cache.');
          return;
        }

        fetch('insere-jogo.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({
            id_solicitacao: idSolicitacao,
            jogo: jogoSelecionado
          })
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('Jogo incluído com sucesso!');
            window.location.href = 'solicitacoes.php';
          } else {
            alert('Erro ao incluir jogo: ' + (data.error || 'Erro desconhecido'));
          }
        })
        .catch(() => alert('Erro na comunicação com o servidor.'));
      });

    });
  </script>
</body>
</html>
