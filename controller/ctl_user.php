<?php
include './model/db_user.php';

$action =$_GET['action'];

switch($action)
{
    case 'register':
        include 'view/view_user/register.php';
        break;
    
    case 'login':
        include 'view/view_user/login.php';
        break;
    
    case 'validRegister':
        $username = $_POST['username'];
        $email= $_POST['email'];
        $password= $_POST['password'];

        if (DbUser::isUsernameTaken($username))
        {
            header('Location: index.php?ctl=user&action=register&msg_erreur=Nom d\'utilisateur déjà utilisé');
            exit();
        }
        
        if (DbUser::isEmailTaken($email))
        {
            header('Location: index.php?ctl=user&action=register&msg_erreur=Email déjà utilisé');
            exit();
        }
        DbUser::validAjout($username, $email, $password);
        header('Location: index.php?ctl=user&action=login&msg_valid=Inscription validée, veuillez vous connecter');
        break;

    case 'validLogin':
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // Récupérer l'utilisateur en fonction du nom d'utilisateur et du mot de passe
            $user = DbUser::getUser($username, $password);
            
            if($user)
            {
                // L'utilisateur est authentifié avec succès
                $_SESSION['username'] = $user['username'];
                $_SESSION["email"] = $user['email'];
                $_SESSION["id_user"] = $user['id_user'];
                $_SESSION["id_role"] = $user['id_role'];
                header('Location: index.php?ctl=annonce&action=vueAnnonces');
            }
            else
            {
                // Identifiants incorrects
                header('Location: index.php?ctl=user&action=login&msg_erreur=Nom d\'utilisateur ou mot de passe incorrect');
            }
        }
        break;

        case 'deconnect':
            //appel à la base de donnée le modele
            session_unset();
            session_destroy();
            //appel à la vue
            header('Location: index.php');
            break;
        
        case 'profilUser':
            $id_user = $_SESSION['id_user'];
            $infoUser = DbUser::getInfoUser($id_user);
            include 'view/view_user/profil_user.php';
            break;

        case 'listeUser':
            $id_user = $_SESSION['id_user'];
            $infoUser = DbUser::getListeUser();
            include 'view/view_user/admin_list_user.php';
            break;
        
        case 'deleteUser':
            $id_user = $_GET['id_user'];
            DbUser::deleteUser($id_user);
            $infoUser = DbUser::getListeUser();
            include 'view/view_user/admin_list_user.php';
            break;
        
        case 'updateUser':
            $id_user = $_SESSION['id_user'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $name_valo = $_POST['name_valo'];
            $rank_valo = $_POST['rank_valo'];
            $result = DbUser::updateUser($id_user,$username ,$email, $name_valo, $rank_valo);
            if($result == true)
            {
                $infoUser = DbUser::getListeUser();
                header('Location: index.php?ctl=user&action=profilUser&msg_valid=Vos données ont bien été modifiées');
                exit();
            }
            else
            {
                $infoUser = DbUser::getListeUser();
                header('Location: index.php?ctl=user&action=profilUser&msg_erreur=Vos données n\'ont pas été modifiées, veuillez vérifier les données saisies');
                exit();
            }
}

?>