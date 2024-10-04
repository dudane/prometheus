<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Produto</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>Buscar Produto</h1>
<form id="form-busca">
    <label for="busca">Nome do Produto:</label>
    <input type="text" id="produto_nome" name="produto_nome">
    <button type="button" id="buscar-produto">Buscar</button>
</form>
<div id="resultado"></div>

<script>
    $(document).ready(function () {
        $('#buscar-produto').click(function () {
            let produto_nome = $('#produto_nome').val();

            $.ajax({
                url: '../controller/ProdutoController.php',
                type: 'POST',
                data: {
                    acao: 'cadastrarOrcamento-buscarProduto',
                    produto_nome: produto_nome
                },
                success: function (response) {
                    console.log(response);  // Verifica a resposta no console
                    let resultado = $('#resultado');
                    resultado.empty();

                    if (response) {
                        try {
                            let produtos = JSON.parse(response);
                            console.log(produtos);  // Verifica se o JSON foi parseado corretamente
                            if (produtos && produtos.length > 0) {
                                let tabela = '<table border="1"><tr><th>ID</th><th>Nome</th><th>Modelo/Tipo</th><th>Marca</th><th>Preço Compra</th><th>Preço Venda</th><th>Quantidade</th></tr>';

                                produtos.forEach(function (produto) {
                                    tabela += `<tr>
                                                    <td>${produto.id}</td>
                                                    <td>${produto.nome}</td>
                                                    <td>${produto.modelo_tipo}</td>
                                                    <td>${produto.marca}</td>
                                                    <td>${produto.preco_compra}</td>
                                                    <td>${produto.preco_venda}</td>
                                                    <td>${produto.quantidade_estoque}</td>
                                                </tr>`;
                                });

                                tabela += '</table>';
                                resultado.html(tabela);
                            } else {
                                resultado.html('<p>Nenhum produto encontrado.</p>');
                            }
                        } catch (e) {
                            resultado.html('<p>Erro ao processar a resposta do servidor.</p>');
                        }
                    } else {
                        resultado.html('<p>Nenhum produto encontrado.</p>');
                    }
                },
                error: function () {
                    $('#resultado').html('<p>Erro ao buscar o produto.</p>');
                }
            });
        });
    });
</script>
</body>
</html>
