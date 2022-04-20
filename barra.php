<body class="sidebar-mini sidebar-collapse">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <h1>Sistema de Separação de Pedidos</h1>
            </ul>
            <!-- SEARCH FORM -->


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">


                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-danger elevation-4">
            <!-- Brand Logo -->


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                </div>

                <!-- SidebarSearch Form -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <?php
                        $menu = $_SESSION['menu'];
                        if ($menu == 1) {
                        ?>


                            <li class="nav-item menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Separação
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="painel_index.php" class="nav-link">
                                            <i class="fas fa-cart-arrow-down"></i>
                                            <p>Emitir Separação</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="painel_fin_separ.php" class="nav-link">
                                            <i class="fas fa-truck-loading"></i>
                                            <p>Finalizar Separação</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="entrar.php" class="nav-link">
                                    <i class="fa-solid fas fa-arrow-right"></i>
                                    <p>
                                        Sair
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>
                            </li>
                        <?php
                        } else if ($menu == 2) {

                        ?> <li class="nav-item menu-open">

                            <?php
                        } else if ($menu == 3) {
                            ?>
                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Gestão
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/index.php" class="nav-link">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Funcionários</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/competencias.php" class="nav-link">
                                            <i class="fas fa-calendar-alt nav-icon"></i>
                                            <p>Competências</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item menu-open">
                                <a href="" class="nav-link active">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                        Relatórios
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/relatorio.php" class="nav-link active">
                                            <i class="fas fa-history"></i>
                                            <p>Histórico por competência</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        } else if ($menu == 4) {
                        ?>
                            <li class="nav-item menu-close">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Gestão
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/index.php" class="nav-link ">
                                            <i class="fas fa-truck "></i>
                                            <p>Caminhão</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../layout/motorista.php" class="nav-link ">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Motorista</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item menu-open">
                                <a href="" class="nav-link active">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                        Relatórios
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/relatorio.php" class="nav-link ">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <p>Despesas por caminhão</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/relatorio2.php" class="nav-link active">
                                            <i class="fas fa-users"></i>
                                            <p>Diárias por motorista</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/relatorio3.php" class="nav-link">
                                            <i class="fas fa-truck-loading"></i>
                                            <p>Entrega por Material</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        } else if ($menu == 5) {
                        ?>
                            <li class="nav-item menu-close">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Gestão
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/index.php" class="nav-link ">
                                            <i class="fas fa-truck "></i>
                                            <p>Caminhão</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../layout/motorista.php" class="nav-link ">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Motorista</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item menu-open">
                                <a href="" class="nav-link active">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                        Relatórios
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/relatorio.php" class="nav-link ">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <p>Despesas por caminhão</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/relatorio2.php" class="nav-link ">
                                            <i class="fas fa-users "></i>
                                            <p>Diárias por motorista</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../layout/relatorio3.php" class="nav-link active">
                                            <i class="fas fa-truck-loading"></i>
                                            <p>Entrega por Material</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>