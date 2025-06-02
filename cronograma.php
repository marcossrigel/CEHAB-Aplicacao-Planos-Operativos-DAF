<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cronograma</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f0f4f8;
      padding: 30px;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h1 {
      font-size: 24px;
      text-align: center;
      margin-bottom: 25px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table th, table td {
      border: 1px solid #ddd;
      padding: 10px;
      font-size: 14px;
    }

    table th {
      background-color: #e3e8ef;
      text-align: left;
    }

    input[type="text"],
    input[type="date"],
    textarea {
      width: 100%;
      padding: 6px;
      font-size: 13px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .actions {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .actions button {
      padding: 10px 20px;
      font-size: 14px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .btn-salvar { background-color: #22c55e; color: #fff; }
    .btn-voltar { background-color: #3b82f6; color: #fff; }
    .btn-linha { background-color: #06b6d4; color: #fff; margin-right: 10px; }
    .btn-linha:hover, .btn-voltar:hover, .btn-salvar:hover { opacity: 0.9; }

    @media (max-width: 768px) {
      table th, table td {
        font-size: 12px;
        padding: 6px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 id="titulo-cronograma">Cronograma</h1>

    <form action="#" method="post">
      <table id="tabela-marcos">
        <thead>
          <tr>
            <th>Item</th>
            <th>Etapa</th>
            <th>Responsável</th>
            <th>Início Previsto</th>
            <th>Término Previsto</th>
            <th>Variação Dias</th>
            <th>%</th>
            <th>Início Real</th>
            <th>Término Real</th>
            <th>Status</th>
            <th>Observação</th>
            <th>Problemática</th>
            <th>Ação Corretiva</th>
            <th>Responsável</th>
            <th>Prazo</th>
            <th>% da Etapa</th>
            <th>Peso</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="item[]"></td>
            <td><textarea name="etapa[]"></textarea></td>
            <td><input type="text" name="responsavel[]"></td>
            <td><input type="date" name="inicio_previsto[]"></td>
            <td><input type="date" name="termino_previsto[]"></td>
            <td><input type="text" name="variacao_dias[]"></td>
            <td><input type="text" name="percentual[]"></td>
            <td><input type="date" name="inicio_real[]"></td>
            <td><input type="date" name="termino_real[]"></td>
            <td><input type="text" name="status[]"></td>
            <td><textarea name="observacao[]"></textarea></td>
            <td><textarea name="problematica[]"></textarea></td>
            <td><textarea name="acao_corretiva[]"></textarea></td>
            <td><input type="text" name="responsavel_acao[]"></td>
            <td><input type="date" name="prazo[]"></td>
            <td><input type="text" name="porcento_etapa[]"></td>
            <td><input type="text" name="peso[]"></td>
          </tr>
        </tbody>
      </table>

      <div class="actions">
        <div>
          <button type="button" class="btn-linha" onclick="adicionarLinha()">Adicionar Linha</button>
          <button type="button" class="btn-linha" onclick="removerLinha()">Remover Linha</button>
        </div>
        <div>
          <button type="submit" class="btn-salvar">Salvar</button>
          <button type="button" class="btn-voltar" onclick="window.history.back()">&lt; Voltar</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    function adicionarLinha() {
      const tabela = document.querySelector("#tabela-marcos tbody");
      const novaLinha = tabela.rows[0].cloneNode(true);
      novaLinha.querySelectorAll("input, textarea").forEach(input => input.value = "");
      tabela.appendChild(novaLinha);
    }

    function removerLinha() {
      const tabela = document.querySelector("#tabela-marcos tbody");
      if (tabela.rows.length > 1) tabela.deleteRow(-1);
    }

    // Definir nome do cronograma dinamicamente (ex: "Cronograma Locação de Veículos")
    const iniciativa = "Veículos"; // exemplo fixo, substitua por PHP dinâmico se quiser
    const tipo = "Locação";
    document.getElementById("titulo-cronograma").innerText = `Cronograma ${tipo} de ${iniciativa}`;
  </script>
</body>
</html>
