<?php
namespace APP\Controller;

require_once "../../vendor/autoload.php";

use APP\Model\HelperRedirect;
use APP\Model\User;
use APP\Model\DAO\UserDAO;
use APP\Model\Validation;

session_start();

$request = $_GET['request'];

match ($request) {
    'sign-up' => sign_up(),
    'sign-in' => sign_in(),
    'list-of-users' => list_of_users(),
    'edit' => edit_user(),
    'update' => update_user(),
    'delete' => delete(),
    default => "Erro",
};

function sign_up()
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation_errors = array(
        'name_error' => array(),
        'email_error' => array(),
        'password_error' => array(),
        'error_signUp' => array(),
    );

    $findUser = UserDAO::findUserByEmail($email);

    if ($findUser) {
        array_push($validation_errors['email_error'], 'Este usuário já existe');
    }

    if (!Validation::isValidName($name)) {
        array_push($validation_errors['name_error'], 'Nome inválido');
    }

    if (!Validation::isValidEmail($email)) {
        array_push($validation_errors['email_error'], 'Email inválido');
    }

    if (!Validation::isValidPassword($password)) {
        array_push($validation_errors['password_error'], 'A senha deve conter no minímo 8 caracteres');
    }

    // Cada chave que possuir um array com um valor inserido será um erro
    $has_errors = false;

    foreach ($validation_errors as $errors) {
        if (!empty($errors)) {
            $has_errors = true;
            break;
        }
    }

    if (!$has_errors) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $user = new User(
            id: 0,
            name: $name,
            email: $email,
            password: $password
        );

        UserDAO::save($user);
        HelperRedirect::redirect("../../index.php");
    } else {
        HelperRedirect::redirectWithMessage(
            message: $validation_errors,
            session_name: 'validation_errors',
            view: '../view/form-signUp.php'
        );
    }
}

function sign_in()
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation_errors = array(
        // 'not_exist_user_error' => array(),
        'email_error' => array(),
        'password_error' => array(),
    );

    $findUser = UserDAO::findUserByEmail($email);


    if (!$findUser) {
        array_push($validation_errors['email_error'], 'Este usuário não existe');
    }

    if (!password_verify($password, $findUser['password'])) {
        array_push($validation_errors['password_error'], "Senha incorreta");
    }

    if (!Validation::isValidEmail($email)) {
        array_push($validation_errors['email_error'], 'Email inválido');
    }

    if (!Validation::isValidPassword($password)) {
        array_push($validation_errors['password_error'], 'A senha deve conter no minímo 8 caracteres');
    }

    // Cada chave que possuir um array com um valor inserido será um erro
    $has_errors = false;

    foreach ($validation_errors as $errors) {
        if (!empty($errors)) {
            $has_errors = true;
            break;
        }
    }

    if (!$has_errors) {
        // HelperRedirect::redirect('../../index.php');
        $user_data = array(
            'id' => $findUser['id_user'],
            'name' => $findUser['name'],
            'email' => $findUser['email'],
            'password' => $findUser['password'],
        );

        HelperRedirect::redirectWithMessage(
            message: serialize($user_data),
            session_name: 'user_login',
            view: '../../index.php'
        );
    } else {
        HelperRedirect::redirectWithMessage(
            message: $validation_errors,
            session_name: 'validation_errors',
            view: '../view/form-signIn.php'
        );
    }
}

function list_of_users()
{
    $users = UserDAO::findAll();

    $has_user = true;

    if ($has_user) {
        HelperRedirect::redirectWithMessage(
            message: $users,
            session_name: 'list_of_users',
            view: '../view/list.php'
        );
    }
}

function edit_user()
{
    if (!isset($_GET['id_user'])) {
        HelperRedirect::redirect('../view/list.php');
    }

    $find_user = UserDAO::getUserById($_GET['id_user']);

    if ($find_user) {
        HelperRedirect::redirectWithMessage(
            message: $find_user,
            session_name: 'user_edit_data',
            view: '../view/edit-user.php'
        );
    }
}

function update_user()
{
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation_errors = array(
        'exist_user_error' => array(),
        'name_error' => array(),
        'email_error' => array(),
        'password_error' => array(),
        'empty_password_error' => array(),
    );

    $findUser = UserDAO::findUserByEmail($email);

    if ($findUser) {
        array_push($validation_errors['exist_user_error'], 'Este usuário já existe');
    }

    if (!Validation::isValidName($name)) {
        array_push($validation_errors['name_error'], 'Nome inválido');
    }

    if (!Validation::isValidEmail($email)) {
        array_push($validation_errors['email_error'], 'Email inválido');
    }

    if (!Validation::isValidPassword($password)) {
        array_push($validation_errors['password_error'], 'A senha deve conter no minímo 8 caracteres');
    }

    if (empty($password)) {
        array_push($validation_errors['empty_password_error'], 'O campo senha não pode estar vazio');
    }

    // Cada chave que possuir um array com um valor inserido será um erro
    $has_errors = false;

    foreach ($validation_errors as $errors) {
        if (!empty($errors)) {
            $has_errors = true;
            break;
        }
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $user = new User(
        id: $id_user,
        name: $name,
        email: $email,
        password: $password
    );

    UserDAO::update($user);

    $user_data = array(
        'id' => $id_user,
        'name' => $name,
        'email' => $email,
        'password' => $password,
    );
    HelperRedirect::redirectWithMessage(
        message: serialize($user_data),
        session_name: 'user_login',
        view: '../view/list.php'
    );

    if ($has_errors) {
        HelperRedirect::redirectWithMessage(
            message: $validation_errors,
            session_name: 'validation_errors',
            view: '../view/edit-user.php'
        );

    }

}

function delete()
{
    // $getUser = UserDAO::getUserById($_GET['id_user']);
    
    UserDAO::delete($_GET['id_user']);

    HelperRedirect::redirect("../view/list.php");
}
?>