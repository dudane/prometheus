<?php
session_start();
require_once '../config/islogado.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AUTO MASTER - Buscar Clientes</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include 'menuEsquerdo.php'
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <?php
                    include 'alertas.php';
                    ?>

                    <!-- Nav Item - Messages -->
                    <?php
                    include 'mensagens.php'
                    ?>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <?php

                    include 'informacoes_usuario.php'

                    ?>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <!--<h1 class="h3 mb-4 text-gray-800">Buscar Orçamento</h1> -->

                <!-- Orcamento -->
                <form method="POST" action="../controller/ClienteController.php">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Buscar Orçamento</h6>
                        </div>
                        <div class="card-body">
                            <div id="buscarCliente">
                                <div class="form-row align-items-end">
                                    <!-- Campo de busca do cliente -->
                                    <div class="col-md-3">
                                        <label for="busca">Cliente</label>
                                        <input type="text" class="form-control" id="busca" name="busca"
                                               placeholder="Digite o nome do cliente">
                                        <input type="hidden" id="acao" name="acao" value="buscarClientes-buscarClientes">
                                    </div>

                                    <!-- Campo Código do Orçamento -->
                                    <div class="col-md-2">
                                        <label for="codigo_orcamento">Código:</label>
                                        <input type="text" class="form-control" id="codigo_orcamento" name="codigo_orcamento"
                                               placeholder="Código">
                                    </div>

                                    <!-- Campo Data de Início -->
                                    <div class="col-md-3">
                                        <label for="data_inicio">Data de Início</label>
                                        <input type="date" class="form-control" id="data_inicio" name="data_inicio">
                                    </div>

                                    <!-- Campo Data de Fim -->
                                    <div class="col-md-3">
                                        <label for="data_fim">Data de Fim</label>
                                        <input type="date" class="form-control" id="data_fim" name="data_fim">
                                    </div>

                                    <!-- Botão Buscar alinhado à direita -->
                                    <div class="col-md-1 text-right">
                                        <button type="submit" class="btn btn-primary" id="btnBuscarCliente">Buscar</button>
                                    </div>
                                </div>

                                <?php
                                if (isset($_SESSION['clientes'])) {
                                    $clientes = $_SESSION['clientes'] ?? [];

                                    echo "<div class='table-responsive mt-4'>";
                                    echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>Nome</th>";
                                    echo "<th>CPF</th>";
                                    echo "<th>Telefone</th>";
                                    echo "<th>Email</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

                                    unset($_SESSION['clientes']); // Limpa a sessão após exibir os resultados
                                    if (!empty($clientes)) {
                                        foreach ($clientes as $cliente) {
                                            echo "<tr>";
                                            echo "<td>" . $cliente['nome'] . "</td>";
                                            echo "<td>" . $cliente['cpf_cnpj'] . "</td>";
                                            echo "<td>" . $cliente['telefone'] . "</td>";
                                            echo "<td>" . $cliente['email'] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php
include 'logout_modal.php'
?>
<script>
    $(document).ready(function () {
        // Buscar Orcamentos
        $('#btnBuscarOrcamento').click(function () {
            let formData = $('#formBuscarOrcamento').serialize() + '&acao=buscarOrcamento-buscar';
            $.ajax({
                url: '../controller/OrcamentoController.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    let resultado = $('#orcamentosResultado');
                    resultado.empty();
                    if (response) {
                        try {
                            let orcamentos = JSON.parse(response);

                        } catch (e) {
                            resultado.html('<p>Erro ao processar a resposta (serviço) do servidor.</p>');
                        }
                    }else{
                        resultado.html('<p>Nenhum orçamento encontrado.</p>');
                    }
                },
                error: function () {
                    $('#orcamentosResultado').html('<p>Erro ao buscar o orçamentos.</p>');
                }

            });
        });
    });
</script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>