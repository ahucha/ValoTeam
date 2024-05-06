<?php
session_start();

include 'view/header.php';

// Inclure la navbar si l'utilisateur est connecté
if (isset($_SESSION["id_user"]))
{
    include 'view/navbar.php';
}

// Vérifier si une action spécifique est demandée
if(isset($_GET['ctl'])) 
{
    switch($_GET['ctl']) 
    {
        case 'user':
            include 'controller/ctl_user.php';
            break;
        case 'annonce':
            include 'controller/ctl_annonce.php';
            break;
        // Ajoutez d'autres cas si nécessaire
        default:
            include 'controller/ctl_annonce.php';
            break;
    }
}
else
{
    // Si aucun contrôleur n'est spécifié, inclure la page de connexion si l'utilisateur n'est pas connecté
    if (!isset($_SESSION["id_user"]))
    {
        include "view/view_user/login.php";
    }
}

include 'view/footer.php';
?>
