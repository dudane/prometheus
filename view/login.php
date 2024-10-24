<?php session_start();?>
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
        

        
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- Coluna da imagem à esquerda -->
                            <div class="col-lg-6 d-flex align-items-center justify-content-center flex-column">
                                <img src="img/logo_name.fw.png" alt="Login Image" class="login-image">
                                <p class="image-text"><strong>Simplifique a gestão, acelere o sucesso!</strong></p>
                            </div>

                            <!-- Coluna da direita (Formulário de login) -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Entrar no sistema</h1>
                                    </div>
                                    <form class="user" method="POST" action="../controller/login_processo.php"">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Email..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="senha" name="senha" placeholder="Senha" required>
                                            <input type="hidden" name="id_empresa" id="id_empresa" value="1">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Lembrar-me</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                        
                                        <hr>
                                        <!--
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login com Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login com Facebook
                                        </a>
                                        -->
                                    </form>
                                    <script>
                                        function validarSenha() {
                                            /*
                                            const senha = document.getElementById('senha').value;
                                            if (senha.length < 3) {
                                                alert('A senha deve ter no mínimo 3 caracteres.');
                                                return false; // Impede o envio do formulário
                                            }*/
                                            return true; // Permite o envio do formulário
                                        }

                                    </script>
                                    <?php 
                                    // Exibindo mensagem de erro se houver
                                    if (isset($_SESSION['erro'])) { 
                                        echo '<div class="alert alert-danger mt-3" id="erroemail">' . $_SESSION['erro'] . '</div>'; 
                                        unset($_SESSION['erro']); 
                                    } 
                                    ?>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Esqueceu a senha?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Criar uma conta!</a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End of Row -->
                    </div>
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

</body>

</html>
