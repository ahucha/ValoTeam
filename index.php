<?php
date_default_timezone_set('Europe/Paris');
session_start();

require_once 'view/header.php';

if (isset($_SESSION["id_user"])) {
    require_once 'view/navbar.php';
}

if (isset($_GET['ctl'])) {
    switch ($_GET['ctl']) {
        case 'user':
            require_once 'controller/ctl_user.php';
            break;
        case 'annonce':
            require_once 'controller/ctl_annonce.php';
            break;
        case 'reservation':
            require_once 'controller/ctl_reservation.php';
            break;
        default:
            require_once 'controller/ctl_annonce.php';
            break;
    }
} else {
    if (!isset($_SESSION["id_user"])) {
        require_once "view/view_user/login.php";
    }
}

require_once 'view/footer.php';
?>
