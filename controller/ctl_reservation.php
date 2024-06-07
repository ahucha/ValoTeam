<?php
include './model/db_reservation.php';

$action =$_GET['action'];

switch($action)
{
    case 'addReservation':
        $id_annonce = $_POST['id_annonce'];
        $id_user = $_SESSION['id_user'];
        $statut = 'en_attente';
        DbReservation::addReservation($id_user, $id_annonce, $statut);
        header('Location: index.php?ctl=annonce&action=vueAnnonces');
        exit();
        break;

    case 'refuserReservation':
        $id_reservation = $_POST['id_reservation'];
        DbReservation::refuserReservation($id_reservation);
        header("Location: index.php?ctl=annonce&action=mesAnnonces");
        exit();
        break;

    case 'mesReservations':
        $userId = $_SESSION['id_user'];
        $reservations = DbReservation::getUserReservations($userId);
        include 'view/view_reservation/mesReservations.php';
        break;
    
    case 'supprimerReservation':
        $id_reservation = $_POST['id_reservation'];
        DbReservation::supprimerReservation($id_reservation);
        header("Location: index.php?ctl=reservation&action=mesReservations");
        exit();

    case 'desinscrireReservation':
        $id_reservation = $_POST['id_reservation'];
        $id_annonce = $_POST['id_annonce'];
        
        DbReservation::supprimerReservation($id_reservation);
        DbReservation::incrementNbPlaces($id_annonce);
        
        header('Location: index.php?ctl=reservation&action=mesReservations');
        exit();
        
    
    

}

?>