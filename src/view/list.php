<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
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

    <table class="table table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Senha</th>
                <th scope="col">Editar ou deletar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php if (isset($_SESSION['list_of_users'])): ?>
                    <?php foreach ($_SESSION['list_of_users'] as $user): ?>
                        <td class="align-middle" scope="row">
                            <?= $user['id_user']; ?>
                        </td>
                        <td class="align-middle">
                            <?= $user['name']; ?>
                        </td>
                        <td class="align-middle">
                            <?= $user['email'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $user['password']; ?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-warning">
                                Editar
                                <i class="fa-solid fa-pen ml-2"></i>
                            </a>

                            <a href="#" class="btn btn-outline-danger">
                                Deletar
                                <i class="fa-solid fa-trash ml-2"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</html>