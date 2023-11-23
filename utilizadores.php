<?php

include 'core/init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check(
            $_POST,
            array(
                'username' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users',
                ),
                'password' => array(
                    'required' => true,
                    'min' => 6,
                ),
                'confirm_password' => array(
                    'required' => true,
                    'matches' => 'password',
                ),
                'name' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 50,
                ),
            )
        );

        if ($validation->passed()) {
            $user = new User();

            $salt = Hash::salt(32);

            try {
                $user->create(
                    array(
                        'username' => Input::get('username'),
                        'password' => Hash::make(Input::get('password'), $salt),
                        'salt' => $salt,
                        'name' => Input::get('name'),
                        'joined' => date('Y-m-d H:i:s'),
                        'group' => 1,
                    )
                );

                Session::flash('home', 'You have been registered and can now log in!');
                Redirect::to('visualizar_utilizadores.php');
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error . '<br>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>utilizadores</title>
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
                    <h1 class="mt-4">Cadastrar utilizadores</h1>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Seja bem vindo ao repositorio de monografias da Faculdade de Engenharia e Tecnologias.
                                Este repositorio visa a arquivar os trabalhos de colminacao de cursos na FET de forma
                                electonica</h5>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Formulario de cadastro de utilizador
                        </div>
                        <?php
                        if (isset($_GET['status']) and $_GET['status'] == 'sucesso'):
                            ?>
                            <div class="alert alert-success alert-dismissible">
                                <strong>sucesso!</strong> O usuario foi criado com sucesso.
                            </div>
                            <?php
                        elseif (isset($_GET['erro'])):
                            ?>
                            <div class="alert alert-danger alert-dismissible">
                                <strong>Erro!</strong> Algo deu errado ao tentar criar o usuario.
                            </div>
                            <?php
                        endif;
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-4">
                                        <input class="form-control" id="inputFirstName" name="name" type="text"
                                            placeholder="Enter your first name" required />
                                        <label for="inputFirstName">Nome Completo</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-4">
                                        <input class="form-control" name="username" id="inputFirstName" type="text"
                                            placeholder="Enter your first name" required />
                                        <label for="inputFirstName">nome de utilizador (username)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="password" id="inputLastName" type="password"
                                            placeholder="Enter your last name" required />
                                        <label for="inputLastName">Senha</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating  mb-3 mb-md-4">
                                        <input class="form-control" name="confirm_password" id="inputLastName"
                                            type="password" placeholder="Enter your last name" required />
                                        <label for="inputLastName">Confirmar Senha</label>
                                    </div>
                                </div>

                            </div>
                            <input type="hidden" name="token" value="<?= Token::generete() ?>">
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small"></a>
                                <button type="submit" name="submit" class="btn btn-primary">Submeter</button>
                            </div>
                        </form>

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