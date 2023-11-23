<?php
include 'core/init.php';

$obMonografia = new Monografia();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Repositorio Monografias</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <!-- <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a> -->
                        <a class="nav-link collapsed" href="monografias.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Cadastrar monografia
                        </a>
                        <a class="nav-link collapsed" href="visualizar_monografias.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Visualizar
                        </a>
                        <a class="nav-link collapsed" href="utilizadores.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            cadastrar usuario
                        </a>
                        <a class="nav-link collapsed" href="visualizar_utilizadores.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            visualizar usuarios
                        </a>
                        <a class="nav-link collapsed" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            logout
                        </a>
                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Lista de Monografias</h1>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            Somente o administrador pode Cadastrar as Monografias e Usuarios Normais
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Monografias
                        </div>
                        <div class="card-body">
                            <table class="table" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tema</th>
                                        <th>Autor</th>
                                        <th>Curso</th>
                                        <th>Ano</th>
                                        <th>Acao</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tema</th>
                                        <th>Autor</th>
                                        <th>Curso</th>
                                        <th>Ano</th>
                                        <th>Acao</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    if ($obMonografia->monografias()):
                                        $monografias = $obMonografia->data();
                                        foreach ($monografias as $monografia):
                                            ?>
                                            <tr>
                                                <td>
                                                    <?=$monografia->id?>
                                                </td>
                                                <td>
                                                    <?= $monografia->tema ?>
                                                </td>
                                                <td>
                                                    <?= $monografia->autor ?>
                                                </td>
                                                <td>
                                                    <?= $monografia->curso ?>
                                                </td>
                                                <td>
                                                    <?= $monografia->ano ?>
                                                </td>
                                                <td>
                                                    <a href="editar.php?id=<?=$monografia->id?>">editar</a>
                                                    <a href="deletar.php?id=<?=$monografia->id?>">deletar</a>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
            crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="http://localhost/projecto/assets/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>