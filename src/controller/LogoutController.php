<?php 

include_once "../../vendor/autoload.php";
use APP\Model\HelperRedirect;

session_start();

$request = $_GET['request'];

if (isset($request)) {
    if (isset($_SESSION['user_login'])) {
        session_unset();
        session_destroy();
    }

    HelperRedirect::redirect('../../index.php');
}

?>