<?php
session_start();
require_once '../config/islogado.php';
require_once '../controller/OrcamentoController.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <style>
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
    </style>
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

                <!-- Topbar Search -->
                <!--
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"  method="POST" action="../controller/ClienteController.php">
                     <div class="input-group">
                         <input type="text" id="busca" name="busca" class="form-control bg-light border-0 small" placeholder="Search forrrr..."
                             aria-label="Search" aria-describedby="basic-addon2">
                         <div class="input-group-append">
                             <button class="btn btn-primary" type="submit">
                                 <i class="fas fa-search fa-sm"></i>
                             </button>
                         </div>
                     </div>
                 </form>
                 -->
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

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['usuario_nome']?></span>
                            <img class="img-profile rounded-circle"
                                 src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Sair
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->



                <div class="card shadow mb-4">
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
                                echo "<h2>Orçamento não encontrado!</h2>";
                                exit;
                            }

                    ?>

                            <h1>Orçamento Detalhado #<?= htmlspecialchars($orcamento['id']) ?></h1>

                            <section>
                                <div class="section-title">Informações Gerais</div>
                                <div class="row">
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
                            </section>

                            <section>
                                <div class="section-title">Informações de Produtos</div>
                                <?php if (!empty($orcamento['produtos'])): ?>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nome</th>
                                            <th>Preço Cobrado (R$)</th>
                                            <th>Qtd</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $contadorProduto = 1;
                                        foreach ($orcamento['produtos'] as $produto):
                                            $quantidade = $produto['qtd'] ?? 1; // Define a quantidade padrão como 1
                                            ?>
                                            <tr>
                                                <td><?= $contadorProduto++ ?></td>
                                                <td><?= htmlspecialchars($produto['produto_nome']) ?></td>
                                                <td><?= number_format($produto['preco_cobrado'], 2, ',', '.') ?></td>
                                                <td><?= htmlspecialchars($quantidade) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>Nenhum produto adicionado a este orçamento.</p>
                                <?php endif; ?>
                            </section>


                            <section>
                                <div class="section-title">Informações de Serviços</div>
                                <?php if (!empty($orcamento['servicos'])): ?>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nome</th>
                                            <th>Preço Cobrado (R$)</th>
                                            <th>Qtd</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $contadorServico = 1;
                                        foreach ($orcamento['servicos'] as $servico):
                                            $quantidade = $servico['qtd'] ?? 1; // Define a quantidade padrão como 1
                                            ?>
                                            <tr>
                                                <td><?= $contadorServico++ ?></td>
                                                <td><?= htmlspecialchars($servico['servico_nome']) ?></td>
                                                <td><?= number_format($servico['preco_cobrado'], 2, ',', '.') ?></td>
                                                <td><?= htmlspecialchars($quantidade) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>Nenhum serviço adicionado a este orçamento.</p>
                                <?php endif; ?>
                            </section>


                            <a href="buscarOrcamento.php">Voltar para a lista de orçamentos</a>


                            <a href="buscarOrcamento.php">Voltar para a lista de orçamentos</a>

                    <?php
                        }
                    ?>

                    </div>
                </div>

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

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pronto para Sair?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">Selecione "Sair" abaixo se você estiver pronto para encerrar sua sessão atual.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Sair</a>
            </div>
        </div>
    </div>
</div>

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
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>