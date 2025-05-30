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
    border-collapse: separate;
    border-spacing: 16px 12px; /* 16px entre colunas, 12px entre linhas */
    table-layout: fixed;
    }

    tr.subetapa td[contenteditable] {
    background-color: #f0f0f0;
    font-style: italic;
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
    padding: 0; /* deixamos o padding só no td[contenteditable] */
    }

    td, td[contenteditable] {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    td[contenteditable] {
    border: 1px solid #ccc;
    background-color: #f9f9f9;
    border-radius: 10px;
    padding: 10px;
    min-height: 36px;
    vertical-align: middle;
    box-sizing: border-box;
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
    <button onclick="addSubetapa()">Adicionar Subetapa</button>
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

    function addSubetapa() {
    const tbody = document.querySelector('#tabela-marcos tbody');
    const linhas = Array.from(tbody.querySelectorAll('tr:not(.subetapa)'));

    if (linhas.length === 0) {
        alert('Adicione uma linha principal antes.');
        return;
    }

    const ultimaLinha = linhas[linhas.length - 1];
    const itemBase = ultimaLinha.cells[0].textContent.trim();

    if (!itemBase || isNaN(itemBase)) {
        alert("Digite um número no campo 'ITEM' da linha principal antes de adicionar subetapas.");
        return;
    }

    // Contar quantas subetapas já existem para este item
    const todasAsLinhas = Array.from(tbody.querySelectorAll('tr'));
    let ultimaLinhaDestino = ultimaLinha;
    let subIndice = 1;

    for (let i = 0; i < todasAsLinhas.length; i++) {
        const linha = todasAsLinhas[i];
        const itemTexto = linha.cells[0]?.textContent.trim();

        if (itemTexto?.startsWith(itemBase + ".")) {
        ultimaLinhaDestino = linha;
        const sufixo = itemTexto.split(".")[1];
        const num = parseInt(sufixo);
        if (!isNaN(num) && num >= subIndice) {
            subIndice = num + 1;
        }
        }
    }

    const novaSubetapa = document.createElement('tr');
    novaSubetapa.classList.add('subetapa');

    for (let i = 0; i < 17; i++) {
        const cell = document.createElement('td');
        cell.setAttribute('contenteditable', 'true');
        if (i === 0) {
        cell.textContent = `${itemBase}.${subIndice}`;
        cell.setAttribute('title', cell.textContent);
        }
        novaSubetapa.appendChild(cell);
    }

    // Inserir logo após a última subetapa (ou a linha principal, se for a primeira)
    tbody.insertBefore(novaSubetapa, ultimaLinhaDestino.nextSibling);
}

  </script>

</body>
</html>
