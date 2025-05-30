<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cronograma de Marcos</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f0f2f5;
      margin: 0;
      padding: 40px 20px;
    }

    .table-container {
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      max-width: 95%;
      margin: 0 auto;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      overflow-x: auto;
    }

    table {
      min-width: 1400px;
      border-collapse: separate;
      border-spacing: 20px 0;
      table-layout: fixed;
    }

    .main-title {
      font-size: 26px;
      font-weight: 600;
      text-align: center;
      color: #1d2129;
      margin-bottom: 30px;
    }

    th, td {
      text-align: left;
      font-size: 14px;
      color: #333;
      padding: 10px 5px;
    }

    td, td[contenteditable] {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    td[contenteditable] {
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        border-radius: 6px;
        padding: 8px;
        min-height: 36px;
        vertical-align: middle;
    }

    .button-group {
      margin: 30px auto 0;
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .button-group button {
      padding: 10px 20px;
      background-color: #4da6ff;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    .button-group button:hover {
      background-color: #3399ff;
    }

    @media (max-width: 768px) {
      th, td {
        font-size: 12px;
        padding: 6px 4px;
      }
      .button-group {
        flex-direction: column;
        align-items: center;
      }
      .button-group button {
        width: 100%;
        max-width: 200px;
      }
    }
  </style>
</head>
<body>

<div class="main-title">Cronograma de Marcos</div>
<!-- Tabela -->
<div class="table-container">
    <table id="tabela-marcos">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>ETAPA</th>
                <th>RESPONSÁVEL</th>
                <th>INÍCIO PREVISTO</th>
                <th>TÉRMINO PREVISTO</th>
                <th>VARIAÇÃO DE DIAS</th>
                <th>PERCENTUAL</th>
                <th>INÍCIO REAL</th>
                <th>TÉRMINO REAL</th>
                <th>STATUS</th>
                <th>OBSERVAÇÃO</th>
                <th>PROBLEMATICA</th>
                <th>AÇÃO CORRETIVA</th>
                <th>RESPONSÁVEL</th>
                <th>PRAZO</th>
                <th>% DA ETAPA</th>
                <th>PESO</th>
            </tr>
        </thead>
        <tbody>
            <!-- Linhas serão adicionadas aqui -->
        </tbody>
    </table>
</div>

<div class="button-group">
    <button onclick="addRow()">Adicionar Linha</button>
    <button onclick="removeRow()">Remover Linha</button>
</div>

  <script>
    document.addEventListener('input', function (e) {
        if (e.target && e.target.isContentEditable) {
            e.target.setAttribute('title', e.target.textContent);
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('td[contenteditable]').forEach(td => {
        td.setAttribute('title', td.textContent);
    });
    });

    function addRow() {
      const tbody = document.querySelector('#tabela-marcos tbody');
      const row = document.createElement('tr');

      for (let i = 0; i < 17; i++) {
        const cell = document.createElement('td');
        cell.setAttribute('contenteditable', 'true');
        row.appendChild(cell);
      }

      tbody.appendChild(row);
    }

    function removeRow() {
      const tbody = document.querySelector('#tabela-marcos tbody');
      if (tbody.lastChild) {
        tbody.removeChild(tbody.lastChild);
      }
    }
  </script>

</body>
</html>
