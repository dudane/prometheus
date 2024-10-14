<?php
session_start();
require_once '../config/islogado.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Headers e estilos -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Cadastro de Orçamento</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top">

<div id="wrapper">

    <!-- Sidebar -->
    <?php include 'menuEsquerdo.php' ?>
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- Topbar -->
            <?php include 'topbar.php'; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <form id="formCriarOrcamento" action="../controller/OrcamentoController.php" method="post">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Criar Orçamento</h1>

                    <!-- Formulário de Cadastro de Orçamento -->
                    <!-- Cliente -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Preencha as informações do cliente</h6>
                        </div>
                        <div class="card-body">
                            <div id="buscarCliente">
                                <div class="form-group">
                                    <label for="cliente_nome">Cliente</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cliente_nome" name="cliente_nome"
                                               placeholder="Digite o nome do cliente" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" id="btnBuscarCliente">Buscar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Serviços -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Preencha as informações dos serviços</h6>
                        </div>
                        <div class="card-body">
                            <div id="buscarServico">
                                <div class="form-group">
                                    <label for="servico_nome">Serviço:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="servico_descricao" name="servico_descricao"
                                               placeholder="Digite o nome de um serviço" >
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" id="btnBuscarServico">Buscar
                                            </button>
                                            <div id="servicosSelecionados">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Peças/Produtos -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Preencha as informações dos produtos</h6>
                        </div>
                        <div class="card-body">
                            <!-- Peças -->
                            <div id="buscarProduto">
                                <div class="form-group">
                                    <label for="cliente_nome">Peça:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="produto_nome" name="produto_nome"
                                               placeholder="Digite o nome de uma peça ou produto" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" id="btnBuscarProduto">Buscar
                                            </button>
                                        </div>

                                        <div id="resultado"></div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Resumo -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Resumo</h6>
                        </div>
                        <div class="card-body">
                            <!-- resumo -->
                            <div id="orcamentoFinal">
                                <div class="form-group">

                                    <div class="input-group">

                                        <div class='table-responsive' >
                                            <table class='table table-bordered' id='resumoOrcamento' width='100%' cellspacing='0'>
                                                <thead>
                                                <tr class="bg-gradient-info text-white">
                                                    <th>Serviços</th>
                                                    <th>R$ 0,00</th>
                                                    <th>Peças:</th>
                                                    <th>R$ 0,00</th>
                                                    <th>Valor Total:</th>
                                                    <th>R$ 0.00</th>
                                                </tr>
                                                </thead>
                                            </table>
                                            <div class="text-right" >
                                                <a href="#" class="btn btn-success btn-icon-split" id="salvarOrcamento" >
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <span class="text">Salvar Orçamento</span>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Modal para listar clientes -->
                    <div class="modal fade" id="modalClientes" tabindex="-1" role="dialog"
                         aria-labelledby="modalClientesLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalClientesLabel">Lista de Clientes</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="clientesResultado"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para listar serviços -->
                    <div class="modal fade" id="modalServicos" tabindex="-1" role="dialog"
                         aria-labelledby="modalServicosLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalServicosLabel">Lista de Serviços</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="servicosResultado"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para listar produtos -->
                    <div class="modal fade" id="modalProdutos" tabindex="-1" role="dialog"
                         aria-labelledby="modalProdutosLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalProdutosLabel">Lista de Produtos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="produtosResultado"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para validar orcamento -->
                    <div class="modal fade" id="modalValidacao" tabindex="-1" role="dialog"
                         aria-labelledby="modalValidacaoLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalValidacaoLabel"><strong>Validação</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="modalValidacaoConteudo"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal para mostrar orcamento cadastrado -->
                    <div class="modal fade" id="modalOrcamentoCriado" tabindex="-1" role="dialog"
                         aria-labelledby="modalOrcamentoCriadoLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalOrcamentoCriadoLabel"><strong>Orçamento Criado Com Sucesso</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="modalOrcamentoCriadoConteudo">
                                        ID do Orçamento: <span id="orcamentoId">123</span>

                                        <h6><strong>Detalhes do Orçamento</strong></h6>
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item">ID do Orçamento: <span id="orcamentoId">123</span></li>
                                            <li class="list-group-item">Cliente: <span id="nomeCliente">Fulano de Tal</span></li>
                                            <li class="list-group-item">Data: <span id="dataOrcamento">13/10/2024</span></li>
                                            <li class="list-group-item">Valor Total: <span id="valorTotal">R$ 1.500,00</span></li>
                                            <li class="list-group-item">Status: <span id="statusOrcamento">Aguardando Aprovação</span></li>
                                        </ul>

                                        <h6><strong>Produtos e Serviços</strong></h6>
                                        <div id="itensOrcamento">
                                            <ul class="list-group">
                                                <li class="list-group-item">Produto: Pneu X - Quantidade: 4 - Valor: R$ 1.200,00</li>
                                                <li class="list-group-item">Serviço: Alinhamento - Valor: R$ 300,00</li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="abrirOrcamento">
                                        <i class="fas fa-folder-open"></i> Abrir Orçamento
                                    </button>
                                    <button type="button" class="btn btn-success" id="compartilharWhatsapp">
                                        <i class="fab fa-whatsapp"></i> Compartilhar no WhatsApp
                                    </button>
                                    <button type="button" class="btn btn-info" id="copiarLink">
                                        <i class="fas fa-copy"></i> Copiar Link
                                    </button>
                                    <button type="button" class="btn btn-info" id="imprimirOrcamento">
                                        <i class="fas fa-print"></i> Imprimir
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Fechar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- Botão para abrir a modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalOrcamentoCriado">
                Mostrar Modal
            </button>
            <!-- Script para redirecionar ao fechar a modal -->
            <script>
                function fechar(){
                    //alert("apertou botao fechar");
                }

            </script>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include 'footer.html'; ?>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<!-- Page level plugins -->
<!--
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
                   -->
<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<script>
    $(document).ready(function () {
        //Buscar Cliente
        $('#btnBuscarCliente').click(function () {
            const clienteNome = $('#cliente_nome').val();
            if (clienteNome) {
                $.ajax({
                    url: '../controller/ClienteController.php',
                    method: 'POST',
                    data: {
                        acao: 'cadastrarOrcamento-buscarClienteOrcamento',
                        nome: clienteNome
                    },
                    success: function (response) {
                        $('#clientesResultado').html(response);
                        $('#modalClientes').modal('show');
                    },
                    error: function () {
                        alert('Erro ao buscar clientes. Tente novamente.');
                    }
                });
            } else {
                alert('Por favor, insira o nome do cliente para buscar.');
            }
        });

        // Adiciona um evento para detectar a seleção do cliente
        $(document).on('change', 'input[name="cliente_selecionado"]', function () {
            const clienteId = $(this).val();
            const clienteNome = $(this).closest('tr').find('td').eq(0).text(); // Supondo que a coluna 1 tem o nome do cliente
            const clienteCpfCnpj = $(this).closest('tr').find('td').eq(1).text(); // Supondo que a coluna 2 tem o CPF/CNPJ do cliente
            const telefone = $(this).closest('tr').find('td').eq(2).text(); // Supondo que a coluna 2 tem o telefone do cliente
            const email = $(this).closest('tr').find('td').eq(3).text(); // Supondo que a coluna 2 tem o email/CNPJ do cliente

            // Adiciona o cliente selecionado abaixo do botão de busca
            //$('#cliente_selecionado_info').remove(); // Remove qualquer informação existente

            console.log("Removendo informações do cliente...");
            $('#cliente_selecionado_info').remove();
            console.log("Adicionando informações do cliente...");

            $('#buscarCliente').after(
                `
                <div class="row mt-3" id="cliente_selecionado_info">
                    <div class="col-md-6 form-group">
                        <label for="nome">Nome:</label>
                        <input type="hidden" name="clienteId" value="${clienteId}">
                        <input type="text" class="form-control" id="nome" name="nome" value="${clienteNome}" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" value="${telefone}" required readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="${clienteCpfCnpj}" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label></label>
                    </div>

                    <div id="equipamentos_container" class="col-md-6 form-group">
                        <label for="equipamento">Veículo:</label>
                        <select class="form-control" id="equipamento" name="equipamento" required>
                            <option value="">Carregando...</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label></label>
                    </div>

                `
            );
            $('#cliente_nome').val(''); // Limpa o campo de busca
            $('#cliente_selecionado_info').addClass('cliente-selecionado'); // Adiciona a classe CSS
            // Fecha o modal
            $('#modalClientes').modal('hide');

            // Faz a requisição para buscar os equipamentos do cliente selecionado
            $.ajax({
                url: '../controller/EquipamentoController.php', // Altere para o controlador correto
                method: 'POST',
                data: {
                    acao: 'buscarEquipamentosPorCliente',
                    cliente_id: clienteId
                },
                success: function (equipamentos) {
                    // Limpa o select e popula com os equipamentos recebidos
                    $('#equipamento').empty(); // Limpa o select
                    if (equipamentos.length > 0) {
                        $('#equipamento').append('<option value="">Selecione</option>');
                        // Armazena os dados dos equipamentos em uma variável global
                        window.equipamentosData = equipamentos;

                        // Verifica se existe apenas um equipamento
                        if (equipamentos.length === 1) {
                            const unicoEquipamento = equipamentos[0];
                            $('#equipamento').append('<option value="' + unicoEquipamento.id + '" selected>' + unicoEquipamento.marca + ' - ' + unicoEquipamento.modelo + '</option>');
                            // Dispara o evento de 'change' para preencher os detalhes do equipamento automaticamente
                            $('#equipamento').trigger('change');
                        } else {
                            // existe mais de um equipamento
                            $.each(equipamentos, function (index, equipamento) {
                                $('#equipamento').append('<option value="' + equipamento.id + '">' + equipamento.marca + ' - ' + equipamento.modelo + '</option>');
                            });
                        }
                    } else {
                        $('#equipamento').append('<option value="0">Nenhum equipamento encontrado</option>');
                    }
                },
                error: function () {
                    $('#equipamento').empty().append('<option value="">Erro ao carregar equipamentos</option>');
                }
            });
        });
        // Evento para quando o equipamento for selecionado
        $(document).on('change', '#equipamento', function () {
            console.log('Evento change disparado para #equipamento');
            const equipamentoId = $(this).val();

            if (equipamentoId && equipamentoId !== "0") {
                // Log para depuração antes de acessar find()
                console.log('Equipamentos armazenados:', window.equipamentosData);
                const equipamento = window.equipamentosData.find(eq => eq.id == equipamentoId);
                console.log('Equipamento encontrado:', equipamento);
                if (equipamento) {
                    $('#equipamento_detalhes').remove(); // Remove qualquer informação existente
                    $('#equipamentos_container').after(`

                    <div class="row mt-3" id="equipamento_detalhes" >
                   <!-- <div class="row"> -->
                            <div class="col-md-6 form-group">
                                <label for="marca">Marca:</label>
                                <input type="hidden" name="equipamentoId" value="${equipamentoId}">
                                <input type="text" class="form-control" id="marca" name="marca" value="${equipamento.marca}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="modelo">Modelo:</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" value="${equipamento.modelo}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="numero_serie">Número de Série:</label>
                                <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="${equipamento.cor}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="numero_serie">Identificação:</label>
                                <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="${equipamento.numero_serie}" readonly>
                            </div>
                   <!--</div>-->
                    </div>
                `);
                }
            } else {
                $('#equipamento_detalhes').remove(); // Remove os detalhes se nenhum equipamento válido for selecionado
            }
        });

        //buscar produtos
        $('#btnBuscarProduto').click(function () {
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
                    let resultado = $('#produtosResultado');
                    resultado.empty();

                    if (response) {
                        try {
                            let produtos = JSON.parse(response);
                            console.log(produtos);  // Verifica se o JSON foi parseado corretamente
                            if (produtos && produtos.length > 0) {

                                //let tabela = '<table border="1"><tr class="bg-gray-400"><th>ID</th><th>Nome</th><th>Modelo/Tipo</th><th>Marca</th><th>Preço Compra</th><th>Preço Venda</th><th>Quantidade</th></tr>';
                                let tabela =    "<div class='card shadow mb-4'>";

                                tabela +=       "<div class='card-header py-3'>"+
                                    "</div>"+
                                    "<div class='card-body'>"+
                                    "<div class='table-responsive' >"+
                                    "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>"+
                                    "<thead>"+
                                    "<tr class='bg-gray-400'><th></th><th>Nome</th><th>Modelo/Tipo</th><th>Marca</th><th>Preço Compra</th><th>Preço Venda</th><th>Quantidade</th></tr>"+
                                    "</thead>";

                                tabela += "<tbody>";
                                produtos.forEach(function (produto) {
                                    tabela += `<tr>
                                                    <td><input type='radio' name='produto_selecionado' value='${produto.id}'></td>
                                                    <td>${produto.nome}</td>
                                                    <td>${produto.modelo_tipo}</td>
                                                    <td>${produto.marca}</td>
                                                    <td>R$ ${produto.preco_compra}</td>
                                                    <td>R$ ${produto.preco_venda}</td>
                                                    <td>${produto.quantidade_estoque}</td>
                                                </tr>`;
                                });
                                tabela +=   "</tbody>" +
                                    "</table>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>";
                                resultado.html(tabela);
                                //  $('#modalProdutos').modal('show');
                            } else {
                                resultado.html('<p>Nenhum produto encontrado.</p>');
                                // $('#modalProdutos').modal('show');
                            }
                        } catch (e) {
                            resultado.html('<p>Erro ao processar a resposta (produto) do servidor.</p>');
                        }
                    } else {
                        resultado.html('<p>Nenhum produto encontrado.</p>');
                        //  $('#modalProdutos').modal('show');
                    }
                    $('#modalProdutos').modal('show');
                },
                error: function () {
                    $('#resultado').html('<p>Erro ao buscar o produto.</p>');
                }
            });
        });


        // Adicionar produto selecionado ao formulário principal
        $(document).on('change', 'input[name="produto_selecionado"]', function () {
            // Captura os dados do produto da linha selecionada
            const produtoId = $(this).val();
            const produtoNome = $(this).closest('tr').find('td').eq(1).text(); // Nome do produto
            const produtoModelo = $(this).closest('tr').find('td').eq(2).text(); // Modelo/Tipo
            const produtoMarca = $(this).closest('tr').find('td').eq(3).text(); // Marca
            // Remove quaisquer caracteres não numéricos (exceto ponto e vírgula) e converte para float
            const produtoPrecoTexto = $(this).closest('tr').find('td').eq(4).text(); // Preço Venda (em texto)
            const produtoPreco = parseFloat(produtoPrecoTexto.replace(/[^\d,.-]/g, '').replace(',', '.'));

            // Verifica se a tabela já existe ou não
            if ($('#tabelaProdutosSelecionados').length === 0) {
                // Se a tabela não existe, cria uma nova
                let tabela = `
            <div class='table-responsive'>
                <table class='table table-bordered' id='tabelaProdutosSelecionados' width='100%' cellspacing='0'>
                    <thead>
                        <tr class='bg-gray-600 text-white'>
                            <th>Nome</th>
                            <th>Modelo/Tipo</th>
                            <th>Marca</th>
                            <th>Preço Venda</th>
                            <th>Quantidade</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="hidden" name="produtoId[]" value="${produtoId}">
                                ${produtoNome}</td>
                            <td>${produtoModelo}</td>
                            <td>${produtoMarca}</td>
                            <td class="preco-produto">
                            <input type="hidden" name="produtoIdPrecoCobrado[]" value="${produtoPreco.toFixed(2)}">
                            ${produtoPreco.toFixed(2)}</td>
                            <td><input type="number" name="quantidade-produto[]" class="quantidade-produto" value="1" min="0" style="width: 60px;"></td>
                            <td class="subtotal-produto">${produtoPreco.toFixed(2)}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" style="text-align:right;">Total:</th>
                            <th id="totalPreco">0.00</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        `;
                // Adiciona a tabela após o elemento #buscarProduto
                $('#buscarProduto').after(tabela);
            } else {
                // Se a tabela já existe, adiciona uma nova linha ao tbody
                $('#tabelaProdutosSelecionados tbody').append(`
            <tr>
                <td>
                <input type="hidden" name="produtoId[]" value="${produtoId}">
                ${produtoNome}</td>
                <td>${produtoModelo}</td>
                <td>${produtoMarca}</td>
                <td class="preco-produto">
                <input type="hidden" name="produtoIdPrecoCobrado[]" value="${produtoPreco.toFixed(2)}">
                ${produtoPreco.toFixed(2)}</td>
                <td><input type="number" name="quantidade-produto[]" class="quantidade-produto" value="1" min="0" style="width: 60px;"></td>
                <td class="subtotal-produto">${produtoPreco.toFixed(2)}</td>
            </tr>
        `);
            }

            // Atualiza o total dos preços
            atualizarTotalPrecoProduto();
            atualizarTotal();
            // Limpa o campo de busca e fecha o modal
            $('#produto_nome').val('');
            $('#modalProdutos').modal('hide');
        });

        // Evento para atualizar o subtotal e o total quando a quantidade muda
        $(document).on('input', '.quantidade-produto', function () {
            const quantidade = parseInt($(this).val());
            const $linha = $(this).closest('tr');

            if (quantidade === 0) {
                // Se a quantidade for 0, remove a linha da tabela
                $linha.remove();
            } else {
                const precoProduto = parseFloat($linha.find('.preco-produto').text().replace(',', '.'));
                const subtotal = quantidade * precoProduto;

                // Atualiza o subtotal da linha
                $linha.find('.subtotal-produto').text(subtotal.toFixed(2));
            }

            // Atualiza o total dos preços
            atualizarTotalPrecoProduto();
            atualizarTotal();
        });

        // Função para atualizar o total dos preços
        function atualizarTotalPrecoProduto() {
            let total = 0;
            $('#tabelaProdutosSelecionados .subtotal-produto').each(function () {
                total += parseFloat($(this).text().replace(',', '.'));
            });
            $('#totalPreco').text(total.toFixed(2));
        }

        // Buscar Serviço
        $('#btnBuscarServico').click(function () {
            const servico_descricao = $('#servico_descricao').val();
            //if (servico_descricao) {
            $.ajax({
                url: '../controller/ServicoController.php',
                method: 'POST',
                data: {
                    acao: 'cadastrarOrcamento-buscarServico',
                    servico_descricao: servico_descricao
                },
                success: function (response) {
                    //console.log("Verifica a resposta no console"+response);  // Verifica a resposta no console
                    let resultado = $('#servicosResultado');
                    resultado.empty();
                    if (response) {
                        try{
                            let servicos = JSON.parse(response);
                            //console.log("Verifica se o JSON foi parseado corretamente"+servicos);  // Verifica se o JSON foi parseado corretamente
                            // console.log("tamanho servicos: "+servicos.length);
                            if (servicos && servicos.length > 0) {
                                let tabela =    "<div class='card shadow mb-4'>";
                                tabela +=       "<div class='card-header py-3'>"+
                                    "</div>"+
                                    "<div class='card-body'>"+
                                    "<div class='table-responsive' >"+
                                    "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>"+
                                    "<thead>"+
                                    "<tr class='bg-gray-600 text-white'><th ></th><th>Descrição</th><th>Preço</th></tr>"+
                                    "</thead>";

                                tabela += "<tbody>";
                                servicos.forEach(function (servico) {
                                    tabela += `<tr>
                                                    <td class='text-center'><input type='radio' name='servico_selecionado' value='${servico.id}'></td>
                                                    <td>${servico.descricao}</td>
                                                    <td>${servico.preco}</td>

                                                </tr>`;
                                });
                                tabela +=   "</tbody>" +
                                    "</table>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>";
                                resultado.html(tabela);
                                //  $('#modalProdutos').modal('show');
                                console.log("chegou aqui 4");
                            } else {
                                resultado.html('<p>Nenhum serviço encontrado.</p>');
                                // $('#modalProdutos').modal('show');
                            }
                        } catch (e) {
                            resultado.html('<p>Erro ao processar a resposta (serviço) do servidor.</p>');
                        }
                    } else {
                        resultado.html('<p>Nenhum produto encontrado.</p>');
                        //  $('#modalProdutos').modal('show');
                    }
                    $('#modalServicos').modal('show');
                },
                error: function () {
                    $('#servicosResultado').html('<p>Erro ao buscar o serviço.</p>');
                }
            });
            // }else {
            //     alert('Por favor, insira o nome do serviço para buscar.');
            // }
        });

        // Adiciona um evento para detectar a seleção do serviço
        $(document).on('change', 'input[name="servico_selecionado"]', function () {
            const servicoId = $(this).val();
            const servicoNome = $(this).closest('tr').find('td').eq(1).text(); // Supondo que a coluna 1 tem o nome do serviço
            // Remove quaisquer caracteres não numéricos (exceto ponto e vírgula) e converte para float
            const servicoPrecoTexto = $(this).closest('tr').find('td').eq(2).text(); // Preço Venda (em texto)
            const servicoPreco = parseFloat(servicoPrecoTexto.replace(/[^\d,.-]/g, '').replace(',', '.'));
            // Verifica se a tabela já existe ou não
            if ($('#tabelaServicosSelecionados').length === 0) {
                // Se a tabela não existe, cria uma nova
                let tabela = `
                                <div class='table-responsive'>
                                    <table class='table table-bordered' id='tabelaServicosSelecionados' width='100%' cellspacing='0'>
                                        <thead>
                                            <tr class='bg-gray-600 text-white'>
                                                <th>Descrição</th>
                                                <th>Preço</th>
                                                <th>Quantidade</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                <input type="hidden" name="servicoId[]" value="${servicoId}">
                                                ${servicoNome}</td>
                                                <td class="preco-servico">
                                                <input type="hidden" name="servicoIdPrecoCobrado[]" value="${servicoPreco.toFixed(2)}">
                                                ${servicoPreco.toFixed(2)}</td>
                                                <td><input type="number" name="quantidade-servico[]" class="quantidade-servico" value="1" min="0" style="width: 60px;"></td>
                                                <td class="subtotal-servico">${servicoPreco.toFixed(2)}</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" style="text-align:right;">Total:</th>
                                                <th id="totalPrecoServico">0.00</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            `;
                $('#buscarServico').after(tabela);
            }else{
                $('#tabelaServicosSelecionados tbody').append(
                    `<tr>
                                                <td>
                                                <input type="hidden" name="servicoId[]" value="${servicoId}">
                                                ${servicoNome}</td>
                                                <td class="preco-servico">
                                                <input type="hidden" name="servicoIdPrecoCobrado[]" value="${servicoPreco.toFixed(2)}">
                                                ${servicoPreco.toFixed(2)}</td>
                                                <td><input type="number" name="quantidade-servico[]" class="quantidade-servico" value="1" min="0" style="width: 60px;"></td>
                                                <td class="subtotal-servico">${servicoPreco.toFixed(2)}</td>
                                            </tr>`
                );
            }
            atualizarTotalPrecoServico();
            $('#servico_descricao').val('');
            $('#modalServicos').modal('hide');
            atualizarTotal();
        });

        // Evento para atualizar o subtotal e o total do servico quando a quantidade muda
        $(document).on('input', '.quantidade-servico', function () {
            const quantidade = parseInt($(this).val());
            const $linha = $(this).closest('tr');
            if (quantidade === 0) {
                // Se a quantidade for 0, remove a linha da tabela
                $linha.remove();
            } else {
                const precoProduto = parseFloat($linha.find('.preco-servico').text().replace(',', '.'));
                const subtotal = quantidade * precoProduto;
                // Atualiza o subtotal da linha
                $linha.find('.subtotal-servico').text(subtotal.toFixed(2));
            }
            // Atualiza o total dos preços
            atualizarTotalPrecoServico();
            atualizarTotal();
        });

        // Função para atualizar o total dos preços
        function atualizarTotalPrecoServico() {
            let total = 0;
            $('#tabelaServicosSelecionados .subtotal-servico').each(function () {
                total += parseFloat($(this).text().replace(',', '.'));
            });
            $('#totalPrecoServico').text(total.toFixed(2));
        }

        function atualizarTotal() {
            let totalServico = 0;
            $('#tabelaServicosSelecionados .subtotal-servico').each(function () {
                //totalServico += parseFloat($(this).text().replace(',', '.'));
                totalServico += parseFloat($(this).text());
            });
            $('#totalPrecoServico').text(totalServico.toFixed(2));
            //$('#resumoOrcamento th:contains("Serviços")').next().text(`R$ ${totalServico.toFixed(2).replace('.', ',')}`);
            $('#resumoOrcamento th:contains("Serviços")').next().text(`R$ ${totalServico.toFixed(2)}`);

            let totalProduto = 0; // Aqui você deve calcular o total dos produtos também
            $('#tabelaProdutosSelecionados .subtotal-produto').each(function () {
                //totalProduto += parseFloat($(this).text().replace(',', '.'));
                totalProduto += parseFloat($(this).text());
            });
            $('#totalPrecoProduto').text(totalProduto.toFixed(2));
            //$('#resumoOrcamento th:contains("Peças")').next().text(`R$ ${totalProduto.toFixed(2).replace('.', ',')}`);
            $('#resumoOrcamento th:contains("Peças")').next().text(`R$ ${totalProduto.toFixed(2)}`);

            const valorTotal = totalServico + totalProduto;
            //$('#resumoOrcamento th:contains("Valor Total")').next().text(`R$ ${valorTotal.toFixed(2).replace('.', ',')}`);
            $('#resumoOrcamento th:contains("Valor Total")').next().text(`R$ ${valorTotal.toFixed(2)}`);
        }

        /*
        $('#salvarOrcamento').click(function (event) {
            // Chama validateForm e verifica se a validação foi bem-sucedida
            if (validateForm(event)) {
                // Se a validação passar, envie o formulário
                // Aqui você pode chamar o método para enviar o formulário, como:
                $('#formCriarOrcamento').submit(); // Substitua #seuFormulario pelo ID do seu formulário

                // Atualiza o conteúdo do modal
                let modalOrcamento = $('#modalOrcamentoCriadoConteudo');
                modalOrcamento.html();

                // Exibe o modal
                $('#modalOrcamentoCriado').modal('show');


            }
        });
        */

        $('#salvarOrcamento').click(function (event) {
            event.preventDefault(); // Evita a submissão padrão do formulário

            if (validateForm(event)) {
                // Coleta os dados do formulário
                let formData = $('#formCriarOrcamento').serialize() + '&acao=cadastrarOrcamento-cadastrar';
                console.log(formData);

                // Faz uma requisição AJAX para enviar os dados e receber o JSON
                $.ajax({
                    url: '../controller/OrcamentoController.php', // URL do seu PHP
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                       alert("Chegou aqui: ");
                        if (response.error) {
                            alert('Erro: ' + response.error);
                        } else {
                            // Atualiza o conteúdo do modal com o ID do orçamento

                            $('#modalOrcamentoCriadoConteudo').html(`Orçamento criado com sucesso! ID:<span id="orcamentoId">${response}</pan>`);
                            // Exibe o modal
                            $('#modalOrcamentoCriado').modal('show');

                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Erro na requisição:', error);
                        alert('Erro ao criar o orçamento. Tente novamente.');
                    }
                });
            }
        });


        // Adicionar evento de validação ao formulário
        //document.querySelector('form').addEventListener('submit', validateForm);
        function validateForm(event) {
            let clienteId = 0, equipamentoId = 0;
            // Obtém o valor do clienteId
            if (document.querySelector('input[name="clienteId"]') !== null) {
                clienteId = document.querySelector('input[name="clienteId"]').value;
            }

            // Obtém o valor do equipamentoId
            if (document.querySelector('input[name="equipamentoId"]') !== null) {
                equipamentoId = document.querySelector('input[name="equipamentoId"]').value;
            }
            if (document.querySelector('input[name="produtoId"]') !== null) {
                const hiddenInputs = document.querySelectorAll('input[name="produtoId"]');
                const qtdProdutos = document.querySelectorAll('input[name="quantidade-produto"]');
                // Cria um array para armazenar os valores
                const produtosIds = [];
                const quantidades = [];
                // Itera pelos inputs e armazena os valores no array
                hiddenInputs.forEach(input => {
                    produtosIds.push(input.value);
                });
                qtdProdutos.forEach(input => {
                    quantidades.push(input.value);
                });

                // Exibe os valores no console
                console.log("Produtos:" +produtosIds+"\nQuantidades: "+quantidades);
            }

            let messages = [];

            // Verifica se o clienteId é 0 e adiciona a mensagem correspondente
            if (clienteId === 0) {
                messages.push("- Cliente");
            }
            // Verifica se o equipamentoId é 0 e adiciona a mensagem correspondente
            if (equipamentoId === 0) {
                messages.push("- Veículo");
            }

            // Se houver mensagens de erro, adicione a mensagem inicial e mostre o modal
            if (messages.length > 0) {
                // Adiciona a mensagem inicial antes das mensagens de erro
                let mensagemInicial = "Para criar um orçamento, os campos abaixo devem ser preenchidos:";
                messages.unshift(mensagemInicial); // Insere a mensagem no início do array

                // Atualiza o conteúdo do modal
                let modalValidacao = $('#modalValidacaoConteudo');
                modalValidacao.html(messages.join('<br>')); // Une as mensagens com <br> para quebras de linha

                // Exibe o modal
                $('#modalValidacao').modal('show');

                return false; // Retorna false para indicar que a validação falhou
            }
            return true; // Retorna true para indicar que a validação foi bem-sucedida
        }

        //Funcionalidades da Modal do orcamento criado com sucesso.
        // Exemplo de ID dinâmico de orçamento
        let orcamentoId = $('#orcamentoId').text();
        let urlOrcamento = `https://meusite.com/orcamento.php?id=${orcamentoId}`;

        // Redirecionar para a página do orçamento
        $('#abrirOrcamento').click(function () {
            window.location.href = urlOrcamento;
        });

        // Compartilhar no WhatsApp
        $('#compartilharWhatsapp').click(function () {
            let mensagem = `Confira o orçamento criado! Acesse: ${urlOrcamento}`;
            let url = `https://wa.me/?text=${encodeURIComponent(mensagem)}`;
            window.open(url, '_blank');
        });

        // Copiar link para a área de transferência
        $('#copiarLink').click(function () {
            navigator.clipboard.writeText(urlOrcamento).then(() => {
                alert('Link copiado para a área de transferência!');
            }).catch(err => {
                console.error('Erro ao copiar link:', err);
            });
        });

        // Ação do botão Imprimir
        $('#imprimirOrcamento').click(function () {
            let printContent = document.querySelector('.modal-content').innerHTML;
            let printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write('<html><head><title>Imprimir Orçamento</title></head><body>');
            printWindow.document.write(printContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });

        // Redirecionar para index.php ao fechar a modal
        $('#modalOrcamentoCriado').on('hidden.bs.modal', function () {
            window.location.href = 'index.php';
        });



    });
</script>

</body>

</html>
