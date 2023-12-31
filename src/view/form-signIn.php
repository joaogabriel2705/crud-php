<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Cadastro</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <!-- Navbar (Barra de Navegação) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../../index.php">Sistema crud</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container mt-5">
        <h2>Bem vindo(a) de volta</h2>
        <form action="../controller/UserController.php?request=sign-in" method="POST">
            <!-- Campo de E-mail -->
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu e-mail"
                    required>
                <?php if (isset($_SESSION["validation_errors"]['email_error'])): ?>
                    <?php foreach ($_SESSION["validation_errors"]['email_error'] as $email_error): ?>
                        <span class="text-danger">
                            <?= $email_error ?>
                        </span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Campo de Senha -->
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="password" placeholder="Digite sua senha"
                    required>
                <?php if (isset($_SESSION["validation_errors"]['password_error'])): ?>
                    <?php foreach ($_SESSION["validation_errors"]['password_error'] as $password_error): ?>
                        <span class="text-danger">
                            <?= $password_error ?>
                        </span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Botão de Envio -->
            <button type="submit" class="btn btn-primary" name="btn-signIn">Entrar</button>
        </form>
    </div>
    <?php unset($_SESSION['validation_errors']); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>