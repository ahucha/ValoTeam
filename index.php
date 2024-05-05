<?php
session_start();

include 'view/header.php';

// Vérifier si une action spécifique est demandée (comme l'inscription)
if(isset($_GET['ctl'])) 
{
    // Si c'est le cas, inclure le contrôleur correspondant
    include 'controller/ctl_user.php'; // Supposons que vous avez un contrôleur pour l'inscription
} 
else 
{
    // Sinon, vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        // Si l'utilisateur n'est pas connecté, inclure la page de connexion
        include "view/view_user/login.php";
    } 
    else {
        // Si l'utilisateur est connecté, incluez le contrôleur approprié en fonction de la demande
        include 'view/navbar.php';
        if(isset($_GET['ctl'])) {
            switch($_GET['ctl']) {
                case 'user':
                    include 'controller/ctl_user.php';
                    break;
                case 'annonce':
                    include 'controller/ctl_annonce.php';
                    break;
                // Ajoutez d'autres cas si nécessaire
                default:
                    // Cas par défaut : inclure une page de contenu ou afficher un message d'erreur
                    break;
            }
        }
    }
}

include 'view/footer.php';
?>
