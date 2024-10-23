<?php
session_start();
require_once '../controller/OrcamentoController.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <style>
        /* Centraliza a imagem na coluna usando flexbox */
        image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .login-image {
            width: 60%;
            height: auto;
        }

        .image-text {
            text-align: center;
            margin-top: 10px;
        }
        .progress-step {
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
        }
        .section-title {
            background-color: #6c757d; /* Cinza */
            color: white; /* Texto branco */
            padding: 3px;
            font-size: 1.25rem;
            margin-bottom: 30px;
            margin-top: 30px;
            border-radius: 5px;
            text-align: center;
        }

        body {
        //font-family: Arial, sans-serif;
        //margin: 20px;
        }
        table {
            width: 100%; /* A tabela preencherá 100% da largura disponível */
            border-collapse: collapse; /* Junte as bordas da tabela */
            margin-bottom: 20px; /* Espaço abaixo da tabela */
        }
        th, td {
            border: 0px solid #ddd; /* Bordas para as células */
            padding: 8px; /* Espaço interno das células */
            text-align: left; /* Alinhamento do texto à esquerda */
        }
        th {
            background-color: #f2f2f2; /* Cor de fundo dos cabeçalhos */
        }



    </style>

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="card shadow mb-4">
                        <style>
                            .centralizado {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                width: 100%;
                            }
                        </style>


                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">Orçamento Detalhado</h6> -->
                        </div>
                        <div class="card-body">

                            <!-- Page Heading -->
                            <?php
                            $orcamento_id = isset($_GET['codigo_orcamento']) ? intval($_GET['codigo_orcamento']) : 0;
                            $orcamento = buscarOrcamentoDetalhado(intval($_GET['codigo_orcamento']));
                            if ($orcamento_id !== 0) {
                                if (!$orcamento) {
                                    echo "<h2 class='text-gray-900'>Orçamento não encontrado!</h2>";
                                    exit;
                                }
                                // Inicializamos as variáveis de total
                                $totalProdutos = 0.0;
                                $totalServicos = 0.0;

                                // Arrays para condensar produtos e serviços
                                $produtosCondensados = [];
                                $servicosCondensados = [];

                                // Condensando produtos
                                foreach ($orcamento['produtos'] as $produto) {
                                    $nomeProduto = $produto['produto_nome']; // Supondo que você tenha um campo 'nome' no seu array
                                    $quantidade = $produto['qtd'] ?? 1;
                                    $precoCobrados = $produto['preco_cobrado'];

                                    if (!isset($produtosCondensados[$nomeProduto])) {
                                        // Se o produto não estiver no array, adicionamos
                                        $produtosCondensados[$nomeProduto] = [
                                            'quantidade' => $quantidade,
                                            'preco' => $precoCobrados,
                                            'total' => $precoCobrados * $quantidade,
                                        ];
                                    } else {
                                        // Se já existe, acumulamos a quantidade e atualizamos o total
                                        $produtosCondensados[$nomeProduto]['quantidade'] += $quantidade;
                                        $produtosCondensados[$nomeProduto]['total'] += $precoCobrados * $quantidade;
                                    }
                                }

                                // Condensando serviços
                                foreach ($orcamento['servicos'] as $servico) {
                                    $nomeServico = $servico['servico_nome']; // Supondo que você tenha um campo 'nome' no seu array
                                    $quantidade = $servico['qtd'] ?? 1;
                                    $precoCobrados = $servico['preco_cobrado'];

                                    if (!isset($servicosCondensados[$nomeServico])) {
                                        // Se o serviço não estiver no array, adicionamos
                                        $servicosCondensados[$nomeServico] = [
                                            'quantidade' => $quantidade,
                                            'preco' => $precoCobrados,
                                            'total' => $precoCobrados * $quantidade,
                                        ];
                                    } else {
                                        // Se já existe, acumulamos a quantidade e atualizamos o total
                                        $servicosCondensados[$nomeServico]['quantidade'] += $quantidade;
                                        $servicosCondensados[$nomeServico]['total'] += $precoCobrados * $quantidade;
                                    }
                                }

                                // Soma dos totais
                                foreach ($produtosCondensados as $produto) {
                                    $totalProdutos += $produto['total'];
                                }

                                foreach ($servicosCondensados as $servico) {
                                    $totalServicos += $servico['total'];
                                }

                                // Valor total
                                $valorTotal = $totalProdutos + $totalServicos;

                                ?>

                                <!-- Exibição do Logo e Nome da Empresa -->
                                <?php if (isset($_SESSION['empresa'])): ?>
                                    <div class="centralizado" style="display: flex; justify-content: center; align-items: center; text-align: left; gap: 20px;">

                                        <!-- Coluna 1: Logo -->
                                        <div style="flex: 1; display: flex; justify-content: center;">
                                            <img src="<?php echo $_SESSION['empresa']['logo']; ?>"
                                                 alt="Logo da Empresa"
                                                 style="height: 100px; width: auto;">
                                        </div>

                                        <!-- Coluna 2: Nome, Endereço e Telefone -->
                                        <div style="flex: 2; display: flex; flex-direction: column; justify-content: center;">
                                        <span class="font-weight-bold text-gray-900" style="font-size: 30px; text-align: center;">
                                            <?php echo $_SESSION['empresa']['nome']; ?>
                                        </span>
                                            <span class="font-weight-bold text-gray-900" style="font-size: 15px; margin-top: 5px; text-align: center">
                                            <?php echo $_SESSION['empresa']['endereco'].", ".$_SESSION['empresa']['cidade']." / ".$_SESSION['empresa']['estado'].". Telefone: ".$_SESSION['empresa']['telefone']; ?>
                                        </span>
                                            <span class="font-weight-bold text-gray-900" style="font-size: 15px; margin-top: 5px;">
                                            <!-- <?php echo $_SESSION['empresa']['telefone']; ?> -->
                                        </span>
                                        </div>

                                    </div>
                                    <?php
                                    // Limpar os dados da sessão após utilizá-los
                                    unset($_SESSION['empresa']);
                                    ?>
                                <?php else: ?>
                                    <div class="alert alert-warning" role="alert">
                                        Nenhuma empresa cadastrada!
                                    </div>
                                <?php endif; ?>

                                <h2 style="color: black; text-align: center; margin-bottom: 50px; margin-top: 50px" >Orçamento Detalhado</h2>

                                <section>
                                    <div class="section-title">Informações Gerais</div>
                                    <!--
                                    nesta pagina, coloca um botão para o cliente imprimir, aceitar o orçamento, quando o cliente aceitar, chega uma mensagem no sistema informando.
                                    ao clicar em aceitar, abre-se uma pop up perguntando qual a previsão do dia e horário que o cliente gostaria de mandar o carro. mas este agendamento,
                                    ficaria a cargo da oficina confirmar.
                                    -->
                                    <table>

                                        <tr>
                                            <td><strong>Código do Orçamento:</strong> <?= htmlspecialchars($orcamento['id']) ?></td>
                                            <td><strong>Cliente:</strong> <?= htmlspecialchars($orcamento['nome']) ?></td>
                                            <td><strong>Veículo:</strong> <?= htmlspecialchars($orcamento['marca']) . " " . htmlspecialchars($orcamento['modelo']) . " " . htmlspecialchars($orcamento['ano_fabricacao']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong> <?= htmlspecialchars($orcamento['status_orcamento']) ?></td>
                                            <td><strong>Data de Criação: </strong><?= htmlspecialchars($orcamento['data_criacao']) ?></td>
                                            <td><strong>Data de Validade: </strong><?= htmlspecialchars($orcamento['data_validade']) ?></td>
                                        </tr>
                                    </table>
                                    <!--
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p><strong>Código do Orçamento:</strong> <?= htmlspecialchars($orcamento['id']) ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Cliente:</strong> <?= htmlspecialchars($orcamento['nome']) ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Veículo:</strong> <?= htmlspecialchars($orcamento['marca']) . " " . htmlspecialchars($orcamento['modelo']) . " " . htmlspecialchars($orcamento['ano_fabricacao']) ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Status:</strong> <?= htmlspecialchars($orcamento['status_orcamento']) ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Criado em:</strong> <?= htmlspecialchars($orcamento['data_criacao']) ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Válido até:</strong> <?= htmlspecialchars($orcamento['data_validade']) ?></p>
                                        </div>
                                    </div>
                                    -->
                                </section>
                                <section>
                                    <div class="section-title">Informações de Peças</div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>#</th>
                                            <th>Produto</th>
                                            <th>Preço Unitário</th>
                                            <th>Qtd</th>
                                            <th>Total</th>
                                        </tr>
                                        <?php
                                        $contadorProdutos = 1; // Inicializa contador de produtos
                                        foreach ($produtosCondensados as $nome => $detalhes): ?>
                                            <tr>
                                                <td><?= $contadorProdutos++ ?></td> <!-- Incrementa o contador -->
                                                <td><?= htmlspecialchars($nome) ?></td>
                                                <td>R$ <?= number_format($detalhes['preco'], 2, ',', '.') ?></td>
                                                <td><?= $detalhes['quantidade'] ?></td>
                                                <td>R$ <?= number_format($detalhes['total'], 2, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>

                                    <div class="section-title">Informações de Serviços</div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>#</th>
                                            <th>Serviço</th>
                                            <th>Preço Unitário</th>
                                            <th>Qtd</th>
                                            <th>Total</th>
                                        </tr>
                                        <?php
                                        $contadorServicos = 1; // Inicializa contador de serviços
                                        foreach ($servicosCondensados as $nome => $detalhes): ?>
                                            <tr>
                                                <td><?= $contadorServicos++ ?></td> <!-- Incrementa o contador -->
                                                <td><?= htmlspecialchars($nome) ?></td>
                                                <td>R$ <?= number_format($detalhes['preco'], 2, ',', '.') ?></td>
                                                <td><?= $detalhes['quantidade'] ?></td>
                                                <td>R$ <?= number_format($detalhes['total'], 2, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>

                                    <div class="section-title">Resumo de Valores</div>
                                    <table class="table table-bordered" id="resumoOrcamento">
                                        <tr>
                                            <th>Serviços:</th>
                                            <th>R$ <?= number_format($totalServicos, 2, ',', '.') ?></th>
                                        </tr>
                                        <tr>
                                            <th>Peças:</th>
                                            <th>R$ <?= number_format($totalProdutos, 2, ',', '.') ?></th>
                                        </tr>
                                        <tr>
                                            <th>Valor Total:</th>
                                            <th>R$ <?= number_format($valorTotal, 2, ',', '.') ?></th>
                                        </tr>
                                    </table>
                                </section>

                                <?php
                            }
                            ?>
                            <?php if ($orcamento['status_id'] == 1){ ?>
                                <div id="mensagemConfirmacao" style="display: none;" class="alert alert-success mt-3">
                                    Orçamento aprovado! O agendamento foi realizado para <span id="dataSelecionada"></span>, Turno: <span id="turnoSelecionado"></span>. <br> Obs.: A oficina entrará em contato para confirmar o horário.
                                </div>
                                <div id="mensagemErro" style="display: none;" class="alert alert-danger mt-3">

                                </div>
                                <!-- Botões -->
                                <div style="margin-top: 20px; text-align: center;">

                                    <button class="btn btn-success" id="btnAprovarModal" onclick="abrirModal()">
                                        Aprovar Orçamento
                                    </button>
                                    <button class="btn btn-primary" onclick="window.print();">
                                        Imprimir Orçamento
                                    </button>
                                </div>
                            <?php } ?>
                            <?php if ($orcamento['status_id'] == 2): ?>
                                <div id="mensagemConfirmacao" style="display: block;" class="alert alert-success mt-3">
                                    Orçamento aprovado! O agendamento foi realizado para <?= htmlspecialchars($orcamento['data_agendamento']) ?>, Turno: <?= htmlspecialchars($orcamento['turno_agendamento']) ?>. <br> Obs.: A oficina entrará em contato para confirmar o horário.
                                </div>
                                <!-- Botões -->
                                <div style="margin-top: 20px; text-align: center;">

                                    <button class="btn btn-success" id="btnAprovarModal" onclick="" disabled>
                                        Orçamento Aprovado
                                    </button>
                                    <button class="btn btn-primary" onclick="window.print();">
                                        Imprimir Orçamento
                                    </button>
                                </div>
                            <?php endif; ?>

                            <!-- Mensagem de Confirmação na Página de Orçamento -->


                            <!-- Modal Aprovar Orcamento -->
                            <div class="modal fade" id="modalOrcamento" tabindex="-1" role="dialog"
                                 aria-labelledby="modalOrcamentoLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalOrcamentoLabel">Aprovar Orçamento</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formOrcamento">
                                                <input type="hidden" name="id_orcamento" id="id_orcamento" value="<?= htmlspecialchars($orcamento['id']) ?>">
                                                <div class="form-group">
                                                    <label for="dataAgendamento">Escolha a Data:</label>
                                                    <input type="date" class="form-control" id="dataAgendamento" name="dataAgendamento" required>
                                                </div>
                                                <div>
                                                    <p>Turno:</p>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="turno" id="turno" value="Manhã" required>
                                                        <label class="form-check-label" for="turnoManha">Manhã (8h - 12h)</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="turno" id="turno" value="Tarde" required>
                                                        <label class="form-check-label" for="turnoTarde">Tarde (14h - 18h)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="alert alert-info" role="alert">
                                                    <strong>Observação:</strong> O horário desejado está sujeito à confirmação pela oficina.
                                                </div>
                                                <div class="form-group">
                                                    Tem certeza que deseja aprovar este orçamento?
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" form="formOrcamento" class="btn btn-success">Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Innova Sistemas 2024</span>
        </div>
    </div>
</footer>

<script>
    /*
    $(document).ready(function () {
        //aprovar orcamento
        $('#btnAprovarModal').click(function () {
            alert('oi');
            //$('#modalOrcamento').modal('show');
        });
    });
    */
    function abrirModal(){
        $('#modalOrcamento').modal('show');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const dataInput = document.getElementById('dataAgendamento');
        const hoje = new Date().toISOString().split('T')[0]; // Data atual no formato YYYY-MM-DD
        dataInput.setAttribute('min', hoje); // Define a data mínima

        document.getElementById('formOrcamento').addEventListener('submit', function (event) {
            event.preventDefault(); // Evita o envio padrão

            const data = dataInput.value;
            const turno = document.getElementById('turno').value;

            if (data && turno) {

                let formData = $('#formOrcamento').serialize() + '&acao=orcamentoCliente-autorizar';
                //console.log(formData);


                $.ajax({
                    url: '../controller/OrcamentoController.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.successo) {
                            //alert(response.mensagem);
                            //console.log(`Agendamento confirmado para: ${data} - Turno: ${turno}`);
                            const dataFormatada = formatarData(data); // Formatar a data para DD-MM-YYYY

                            const dataAgendamento = document.getElementById('dataAgendamento').value;
                            const turno = document.getElementById('turno').value;

                            // Exibe a mensagem de confirmação com a data e hora selecionadas
                            document.getElementById('dataSelecionada').innerText = dataFormatada;
                            document.getElementById('turnoSelecionado').innerText = turno;
                            document.getElementById('mensagemConfirmacao').style.display = 'block';

                            // Altera o botão para "Orçamento Aprovado" e o desativa
                            const btnAprovarOrcamento = document.getElementById('btnAprovarModal');
                            btnAprovarOrcamento.innerText = 'Orçamento Aprovado';
                            // Desabilitar o botão
                            btnAprovarOrcamento.disabled = true;
                            btnAprovarOrcamento.classList.add('disabled');

                            // Enviar dados para o backend ou realizar outra ação necessária
                            $('#modalOrcamento').modal('hide'); // Fecha o modal
                        } else {
                            document.getElementById('mensagemErro').innerText = response.mensagem;
                            document.getElementById('mensagemErro').style.display = 'block';
                        }
                    },
                    error: function (xhr, status, error) {
                        document.getElementById('mensagemErro').innerText = 'Erro na requisição:'+ error;
                        document.getElementById('mensagemErro').style.display = 'block';
                    }
                });

            } else {
                alert('Por favor, preencha a data e o horário corretamente.');
            }
        });
    });

    // Função para formatar a data no formato DD-MM-YYYY
    function formatarData(data) {
        const [ano, mes, dia] = data.split('-');
        return `${dia}-${mes}-${ano}`; // Retorna a data formatada como DD-MM-YYYY
    }
</script>


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>
