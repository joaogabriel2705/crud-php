<?php
session_start();

if (isset($_SESSION['user_login'])) {
    $data_user = unserialize($_SESSION['user_login']);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema crud com PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar (Barra de Navegação) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5 ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand align-middle ps-2" href="#">Sistema crud</a>
        <div class="d-flex justify-content-between collapse navbar-collapse" id="navbarNav">
            <?php if (isset($_SESSION['user_login'])): ?>
                <div class="dropdown" pr-2>
                    <a class="btn btn-secondary dropdown-toggle align-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    </a>

                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <strong>Olá
                                <?= $data_user['name'] ?>!
                            </strong>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">Ver perfil</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="src/controller/LogoutController.php?request=logout">Sair</a>
                        </li>

                        <div class="mt-4">
                            <li>
                                <a class="dropdown-item" href="src/controller/UserController.php?request=list-of-users">Ver
                                    lista de usuarios
                                </a>
                            </li>
                        </div>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <?php if (!isset($_SESSION['user_login'])): ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="src/view/form-signUp.php?request=sign-up">Cadastrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="src/view/form-signIn.php?request=sign-in">Entrar</a>
                </li>
            </ul>
        <?php endif; ?>
    </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>