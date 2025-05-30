<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $iniciativa = $_POST['iniciativa'] ?? '';
    $ib_status = $_POST['ib_status'] ?? '';
    $ib_execucao = $_POST['ib_execucao'] ?? '';
    $ib_secretaria = $_POST['ib_secretaria'] ?? '';
    $ib_orgao = $_POST['ib_orgao'] ?? '';
    $ib_diretoria = $_POST['ib_diretoria'] ?? '';
    $ib_cod_subacao = $_POST['ib_cod_subacao'] ?? '';
    $ib_populacao_beneficiada = $_POST['ib_populacao_beneficiada'] ?? '';
    $ib_tema = $_POST['ib_tema'] ?? '';
    $ib_tipo = $_POST['ib_tipo'] ?? '';
    $ib_responsavel = $_POST['ib_responsavel'] ?? '';
    $data_inicio_previsto = $_POST['data_inicio_previsto'] ?? null;
    $data_termino_previsto = $_POST['data_termino_previsto'] ?? null;
    $data_inicio_real = $_POST['data_inicio_real'] ?? null;
    $data_termino_real = $_POST['data_termino_real'] ?? null;
    $variacao_prevista_dias = $_POST['variacao_prevista_dias'] ?? '';
    $dias_ajustados = $_POST['dias_ajustados'] ?? '';
    $variacao_real_dias = $_POST['variacao_real_dias'] ?? '';
    $diretor = $_POST['diretor'] ?? '';
    $objeto = $_POST['objeto'] ?? '';
    $objetivo = $_POST['objetivo'] ?? '';
    $justificativa = $_POST['justificativa'] ?? '';

    $id_usuarios = $_SESSION['id_usuario'];
    
    $stmt = $conexao->prepare("INSERT INTO iniciativas (
    id_usuarios, iniciativa, ib_status, ib_execucao, ib_secretaria, ib_orgao, ib_diretoria, 
    ib_cod_subacao, ib_populacao_beneficiada, ib_tema, ib_tipo, ib_responsavel, 
    data_inicio_previsto, data_termino_previsto, data_inicio_real, data_termino_real,
    variacao_prevista_dias, dias_ajustados, variacao_real_dias, diretor, objeto, objetivo, justificativa
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


    $stmt->bind_param("issssssssssssssssssssss", // 23 letras: 1 int, 22 strings
        $id_usuarios, $iniciativa, $ib_status, $ib_execucao, $ib_secretaria, $ib_orgao, $ib_diretoria,
        $ib_cod_subacao, $ib_populacao_beneficiada, $ib_tema, $ib_tipo, $ib_responsavel,
        $data_inicio_previsto, $data_termino_previsto, $data_inicio_real, $data_termino_real,
        $variacao_prevista_dias, $dias_ajustados, $variacao_real_dias, $diretor,
        $objeto, $objetivo, $justificativa
    );

    
    if ($stmt->execute()) {
        header("Location: formulario.php?sucesso=1&nome=" . urlencode($iniciativa));
        exit;
    } else {
        echo "Erro ao salvar iniciativa: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário - Nova Iniciativa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    :root {
      --color-white: #fff;
      --color-gray: #e3e8ec;
      --color-dark: #1d2129;
      --color-blue: #0a6be2;
      --color-green: #42b72a;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--color-gray);
      display: flex;
      justify-content: center;
      padding: 40px 20px;
      min-height: 100vh;
    }

    .formulario {
      background-color: var(--color-white);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 1100px;
      width: 100%;
    }

    .main-title {
      font-size: 26px;
      font-weight: 700;
      text-align: center;
      margin-bottom: 30px;
    }

    .linha {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 20px;
    }

    .campo {
      flex: 1;
      min-width: 180px;
      display: flex;
      flex-direction: column;
    }

    label {
      font-size: 14px;
      margin-bottom: 5px;
      font-weight: 600;
    }

    input[type="text"],
    input[type="date"],
    select,
    textarea {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }

    textarea {
      resize: vertical;
      height: 100px;
    }

    button.btn {
      background-color: var(--color-green);
      color: var(--color-white);
      padding: 14px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      width: 220px;
      margin: 30px auto 10px;
      display: block;
    }

    button.btn:hover {
      background-color: #36a420;
    }

    .texto-login {
      text-align: center;
      font-size: 14px;
      margin-top: 15px;
      display: block;
      color: red;
      font-weight: bold;
      text-decoration: none;
    }

    .texto-login:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .formulario {
        padding: 20px;
      }
      .main-title {
        font-size: 22px;
      }
    }
  </style>

</head>

<body>

<form class="formulario" action="formulario.php" method="post">
    <h1 class="main-title">Criar uma Nova Iniciativa</h1>

    <div class="linha">
      <div class="campo">
        <label>Nome da Iniciativa</label>
        <select name="iniciativa" required>
          <option value="">Selecione...</option>
          <option value="Veículos">Veículos</option>
          <option value="Téc. ADM">Téc. ADM</option>
          <option value="Ass. ADM">Ass. ADM</option>
          <option value="Mobiliários">Mobiliários</option>
          <option value="Passagem aérea">Passagem aérea</option>
          <option value="Material Gráfico">Material Gráfico</option>
          <option value="Eventos">Eventos</option>
          <option value="Material de Expediente">Material de Expediente</option>
          <option value="Buffet">Buffet</option>
          <option value="Material de Higiene">Material de Higiene</option>
          <option value="Serviço de Motorista">Serviço de Motorista</option>
          <option value="Licença de Software">Licença de Software</option>
          <option value="Copia de Veículos">Copia de Veículos</option>
          <option value="Estruturar Monitoramento Cehab">Estruturar Monitoramento Cehab</option>
        </select>
      </div>
    </div>

    <div class="linha">
      <div class="campo">
        <label>Status</label>
        <select name="ib_status" required>
          <option value="">Selecione...</option>
          <option value="Em Execução">Em Execução</option>
          <option value="Em Andamento">Em Andamento</option>
          <option value="Liberado">Liberado</option>
        </select>
      </div>
      <div class="campo">
        <label>% de Execução</label>
        <input type="text" name="ib_execucao">
      </div>
      <div class="campo">
        <label>Secretaria</label>
        <input type="text" name="ib_secretaria">
      </div>
      <div class="campo">
        <label>Órgão</label>
        <input type="text" name="ib_orgao">
      </div>
      <div class="campo">
        <label>Diretoria</label>
        <input type="text" name="ib_diretoria">
      </div>
    </div>

    <div class="linha">
      <div class="campo">
        <label>Cód. da Subação</label>
        <input type="text" name="ib_cod_subacao">
      </div>
      <div class="campo">
        <label>População Beneficiada</label>
        <input type="text" name="ib_populacao_beneficiada">
      </div>
      <div class="campo">
        <label>Tema</label>
        <input type="text" name="ib_tema">
      </div>
      <div class="campo">
        <label>Tipo</label>
        <input type="text" name="ib_tipo">
      </div>
      <div class="campo">
        <label>Responsável</label>
        <input type="text" name="ib_responsavel">
      </div>
    </div>

    <div class="linha">
      <div class="campo">
        <label>Início Previsto</label>
        <input type="date" name="data_inicio_previsto" required>
      </div>
      <div class="campo">
        <label>Término Previsto</label>
        <input type="date" name="data_termino_previsto" required>
      </div>
      <div class="campo">
        <label>Início Real</label>
        <input type="date" name="data_inicio_real">
      </div>
      <div class="campo">
        <label>Término Real</label>
        <input type="date" name="data_termino_real">
      </div>
    </div>

    <div class="linha">
      <div class="campo">
        <label>Variação Prevista (DIAS)</label>
        <input type="text" name="variacao_prevista_dias" required>
      </div>
      <div class="campo">
        <label>Dias Ajustados</label>
        <input type="text" name="dias_ajustados" required>
      </div>
      <div class="campo">
        <label>Variação Real (DIAS)</label>
        <input type="text" name="variacao_real_dias" required>
      </div>
    </div>

    <div class="linha">
      <div class="campo">
        <label>Diretor</label>
        <input type="text" name="diretor" required>
      </div>
    </div>

    <div class="linha">
      <div class="campo">
        <label>Objeto</label>
        <input type="text" name="objeto">
      </div>
    </div>

    <div class="linha">
      <div class="campo" style="flex: 1 1 100%">
        <label>Objetivo</label>
        <textarea name="objetivo"></textarea>
      </div>
    </div>

    <div class="linha">
      <div class="campo" style="flex: 1 1 100%">
        <label>Justificativa</label>
        <textarea name="justificativa"></textarea>
      </div>
    </div>

    <button type="submit" class="btn">Criar</button>
    <a href="home.php" class="texto-login">Cancelar</a>
  
</form>

</body>

<script>
  // Mostrar modal de sucesso se "?sucesso=1" estiver na URL
  window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('sucesso') === '1') {
      const nome = urlParams.get('nome');
      document.getElementById('sucessoTexto').innerText = `Iniciativa "${decodeURIComponent(nome)}" cadastrada com sucesso!`;
      document.getElementById('modalSucesso').style.display = 'flex';
    }
  };

  function fecharModal(id) {
    document.getElementById(id).style.display = 'none';
  }

  function confirmarCancelar(event) {
    event.preventDefault();
    document.getElementById('modalCancelar').style.display = 'flex';
  }

  function cancelarConfirmado() {
    window.location.href = 'home.php';
  }
</script>

<div id="modalSucesso" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:1000">
  <div style="background:#fff; padding:30px; border-radius:8px; max-width:400px; text-align:center">
    <h2 style="margin-bottom:15px">Sucesso!</h2>
    <p id="sucessoTexto"></p> 
    <button onclick="window.location.href='home.php'" style="margin-top:20px; padding:10px 20px; background:#42b72a; color:#fff; border:none; border-radius:6px; cursor:pointer">Fechar</button>
    </div>
</div>

<div id="modalCancelar" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:1000">
  <div style="background:#fff; padding:30px; border-radius:8px; max-width:400px; text-align:center">
    <h2 style="margin-bottom:15px">Cancelar Cadastro?</h2>
    <p>Tem certeza que deseja cancelar? Os dados preenchidos serão perdidos.</p>
    <div style="margin-top:20px; display:flex; justify-content:center; gap:15px">
      <button onclick="cancelarConfirmado()" style="padding:10px 20px; background:#e53935; color:#fff; border:none; border-radius:6px; cursor:pointer">Sim, Cancelar</button>
      <button onclick="fecharModal('modalCancelar')" style="padding:10px 20px; background:#ccc; border:none; border-radius:6px; cursor:pointer">Voltar</button>
    </div>
  </div>
</div>

<script>
  document.querySelector('.texto-login').addEventListener('click', confirmarCancelar);
</script>

</html>