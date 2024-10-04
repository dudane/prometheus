<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Serviços</title>
    <script>
        function buscarServicos() {
            const produtoNome = document.getElementById('produto_nome').value;

            // Cria uma requisição AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../controller/ServicoController.php', true); // Altere para o caminho correto do ServicoController.php
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    exibirResultados(response);
                } else {
                    console.error('Erro na requisição:', xhr.statusText);
                }
            };
            xhr.send('acao=cadastrarOrcamento-buscarProduto&produto_nome=' + encodeURIComponent(produtoNome));
        }

        function exibirResultados(servicos) {
            const resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = ''; // Limpa resultados anteriores

            if (servicos.error) {
                resultadosDiv.innerHTML = `<p>${servicos.error}</p>`;
                return;
            }

            if (servicos.length > 0) {
                const ul = document.createElement('ul');
                servicos.forEach(servico => {
                    const li = document.createElement('li');
                    li.textContent = `${servico.descricao} - R$ ${servico.preco}`;
                    ul.appendChild(li);
                });
                resultadosDiv.appendChild(ul);
            } else {
                resultadosDiv.innerHTML = '<p>Nenhum serviço encontrado.</p>';
            }
        }
    </script>
</head>
<body>
<h1>Buscar Serviços</h1>
<form onsubmit="event.preventDefault(); buscarServicos();">
    <label for="produto_nome">Descrição do Serviço:</label>
    <input type="text" id="produto_nome" name="produto_nome" >
    <button type="submit">Buscar</button>
</form>
<div id="resultados"></div>
</body>
</html>
