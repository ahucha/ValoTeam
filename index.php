<?php
session_start();

include 'view/header.php';

// Vérifier si une action spécifique est demandée pour l'utilisateur
if(isset($_GET['ctl']) && $_GET['ctl'] == 'user') {
    // Inclure le contrôleur utilisateur
    include 'controller/ctl_user.php';
} 
else 
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION["id_user"])) 
    {
        // Si l'utilisateur n'est pas connecté, inclure la page de connexion
        include "view/view_user/login.php";
    } 
    else
    {
        // Si l'utilisateur est connecté, inclure la navbar
        include 'view/navbar.php';

        // Vérifier s'il y a une action spécifique demandée
        if(isset($_GET['ctl'])) {
            switch($_GET['ctl']) {
                case 'annonce':
                    // Inclure le contrôleur des annonces
                    include 'controller/ctl_annonce.php';
                    break;
                // Ajoutez d'autres cas si nécessaire
                default:
                    // Inclure un contrôleur par défaut
                    include 'controller/ctl_annonce.php';
                    break;
            }
        }
    }
}

include 'view/footer.php';
?>
