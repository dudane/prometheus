<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"> 
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <!--<i class="fas fa-laugh-wink"></i>-->
                    <img src="img/logo2.png" alt="" style="width: 50px; height: 45px;">

                </div>
                <div class="sidebar-brand-text mx-3">AutoMaster <!--<sup>2</sup>--></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home"></i>
                    <span>Início</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Nav Item - Cliente Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCliente"
                    aria-expanded="true" aria-controls="collapseCliente">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Cliente</span>
                </a>
                <div id="collapseCliente" class="collapse" aria-labelledby="headingCliente" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ações:</h6> 
                        <a class="collapse-item" href="cliente-cadastro.html">Cadastrar</a>
                        <a class="collapse-item" href="cliente-cadastro.html">Editar</a>
                        <a class="collapse-item" href="buscarClientes.php">Buscar</a>
                        <a class="collapse-item" href="cliente-relatorios.html">Relatórios de Clientes</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Veículo Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVeiculo"
                aria-expanded="true" aria-controls="collapseVeiculo">
                <i class="fas fa-fw fa-car"></i>
                <span>Veículo</span>
                </a>
                <div id="collapseVeiculo" class="collapse" aria-labelledby="headingVeiculo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opções de Veículo:</h6>
                        <a class="collapse-item" href="veiculo-page1.html">Página de Veículo 1</a>
                        <a class="collapse-item" href="veiculo-page2.html">Página de Veículo 2</a>
                        <a class="collapse-item" href="veiculo-page3.html">Página de Veículo 3</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrcamento"
                   aria-expanded="true" aria-controls="collapseOrcamento">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Orçamento</span>
                </a>
                <div id="collapseOrcamento" class="collapse" aria-labelledby="headingServico" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opções de Orçamento:</h6>
                        <a class="collapse-item" href="cadastrarOrcamento.php">Cadastrar</a>
                        <a class="collapse-item" href="cliente-cadastro.html">Editar</a>
                        <a class="collapse-item" href="buscarClientes.php">Buscar</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Veículo
            </div>

            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Peça
            </div>

            <!-- Nav Item - Peça Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePeca"
                aria-expanded="true" aria-controls="collapsePeca">
                <i class="fas fa-fw fa-cogs"></i>
                <span>Peça</span>
                </a>
                <div id="collapsePeca" class="collapse" aria-labelledby="headingPeca" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opções de Peça:</h6>
                        <a class="collapse-item" href="peca-page1.html">Página de Peça 1</a>
                        <a class="collapse-item" href="peca-page2.html">Página de Peça 2</a>
                        <a class="collapse-item" href="peca-page3.html">Página de Peça 3</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Serviço
            </div>
             <!-- Nav Item - Serviço Collapse Menu -->

            <!-- Nav Item - Serviço Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServico"
                aria-expanded="true" aria-controls="collapseServico">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Serviço</span>
                </a>
                <div id="collapseServico" class="collapse" aria-labelledby="headingServico" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opções de Serviço:</h6>
                        <a class="collapse-item" href="servico-page1.html">Página de Serviço 1</a>
                        <a class="collapse-item" href="servico-page2.html">Página de Serviço 2</a>
                        <a class="collapse-item" href="servico-page3.html">Página de Serviço 3</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Fornecedor
            </div>

            <!-- Nav Item - Fornecedor Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFornecedor"
                aria-expanded="true" aria-controls="collapseFornecedor">
                <i class="fas fa-fw fa-truck"></i>
                <span>Fornecedor</span>
                </a>
                <div id="collapseFornecedor" class="collapse" aria-labelledby="headingFornecedor" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opções de Fornecedor:</h6>
                        <a class="collapse-item" href="fornecedor-page1.html">Página de Fornecedor 1</a>
                        <a class="collapse-item" href="fornecedor-page2.html">Página de Fornecedor 2</a>
                        <a class="collapse-item" href="fornecedor-page3.html">Página de Fornecedor 3</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.php">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>

        </ul>