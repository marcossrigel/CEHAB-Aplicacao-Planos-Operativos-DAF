<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit;
}

include("config.php");

$id_usuarios = $_SESSION['id_usuario'];
$sql = "SELECT * FROM iniciativas WHERE id_usuarios = $id_usuarios";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Visualizar Iniciativas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e9eef1;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 1000px;
      margin: auto;
    }

    h1 {
      font-size: 26px;
      text-align: center;
      margin-bottom: 20px;
    }

    .accordion {
      background-color: #fff;
      color: #333;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 18px;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .accordion:hover {
      background-color: #f9f9f9;
    }

    .panel {
      padding: 0 0 15px 0;
      display: none;
      background-color: white;
      overflow: hidden;
      border-radius: 0 0 10px 10px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      margin-bottom: 15px;
    }

    .panel p {
      margin: 10px 18px;
      font-size: 15px;
    }

    .seta {
      font-size: 22px;
      transform: rotate(0deg);
      transition: transform 0.3s ease;
    }

    .accordion.active .seta {
      transform: rotate(180deg);
    }

    .botao-voltar {
      display: flex;
      justify-content: center;
      margin-top: 30px;
    }

    .botao-voltar button {
      padding: 10px 20px;
      background-color: #4da6ff;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-weight: bold;
    }

    .botao-voltar button:hover {
      background-color: #3399ff;
    }

    @media (max-width: 768px) {
      .panel p {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
<div class="container">
  <h1>Iniciativas Cadastradas</h1>

  <?php while ($row = $resultado->fetch_assoc()): ?>
    <button class="accordion">
      <strong><?php echo htmlspecialchars($row['iniciativa']); ?></strong>
      <span class="seta">⌄</span>
    </button>
    <div class="panel">
      <p><strong>Status:</strong> <?= $row['ib_status']; ?> | <strong>% Execução:</strong> <?= $row['ib_execucao']; ?></p>
      <p><strong>Secretaria:</strong> <?= $row['ib_secretaria']; ?> | <strong>Órgão:</strong> <?= $row['ib_orgao']; ?> | <strong>Diretoria:</strong> <?= $row['ib_diretoria']; ?></p>
      <p><strong>Cód. Subação:</strong> <?= $row['ib_cod_subacao']; ?> | <strong>Pop. Beneficiada:</strong> <?= $row['ib_populacao_beneficiada']; ?></p>
      <p><strong>Tema:</strong> <?= $row['ib_tema']; ?> | <strong>Tipo:</strong> <?= $row['ib_tipo']; ?> | <strong>Responsável:</strong> <?= $row['ib_responsavel']; ?></p>
      <p><strong>Início Previsto:</strong> <?= $row['data_inicio_previsto']; ?> | <strong>Término Previsto:</strong> <?= $row['data_termino_previsto']; ?></p>
      <p><strong>Início Real:</strong> <?= $row['data_inicio_real']; ?> | <strong>Término Real:</strong> <?= $row['data_termino_real']; ?></p>
      <p><strong>Variação Prevista (dias):</strong> <?= $row['variacao_prevista_dias']; ?> | <strong>Dias Ajustados:</strong> <?= $row['dias_ajustados']; ?> | <strong>Variação Real:</strong> <?= $row['variacao_real_dias']; ?></p>
      <p><strong>Diretor:</strong> <?= $row['diretor']; ?></p>
      <p><strong>Objeto:</strong> <?= $row['objeto']; ?></p>
      <p><strong>Objetivo:</strong> <?= nl2br($row['objetivo']); ?></p>
      <p><strong>Justificativa:</strong> <?= nl2br($row['justificativa']); ?></p>
    </div>
  <?php endwhile; ?>

  <div class="botao-voltar">
    <button onclick="window.location.href='home.php';">&lt; Voltar</button>
  </div>
</div>

<script>
  const accordions = document.querySelectorAll(".accordion");
  accordions.forEach((acc) => {
    acc.addEventListener("click", function () {
      this.classList.toggle("active");
      const panel = this.nextElementSibling;
      panel.style.display = panel.style.display === "block" ? "none" : "block";
    });
  });
</script>
</body>
</html>
