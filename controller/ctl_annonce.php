<?php
include './model/db_annonce.php';

$action = $_GET['action'];

switch ($action) {
    case 'vueAnnonces':
        $userId = $_SESSION["id_user"];
        $category = isset($_GET['category']) ? $_GET['category'] : '';

        if ($category) {
            $annonces = DbAnnonce::getAnnoncesByCategory($category, $userId);
        } else {
            $annonces = DbAnnonce::getAllAnnonces($userId);
        }

        $categories = DbAnnonce::getAllCategories();
        include 'view/view_annonce/annonces.php';
        break;

    case 'formAnnonces':
        $listeCategories = DbAnnonce::getListeCategories();
        include 'view/view_annonce/form_annonce.php';
        break;

    case 'mesAnnonces':
        $id_user = $_SESSION['id_user'];
        $annonces = DbAnnonce::getAnnoncesByUser($id_user);
        $categories = DbAnnonce::getAllCategories();
        include 'view/view_annonce/mesAnnonces.php';
        break;
        

    case 'addAnnonce':
        $titre = $_POST["titre"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $heure = $_POST["heure"];
        $id_categorie = $_POST["id_categorie"];
        $nb_place = $_POST["nb_place"];
        $id_user = $_SESSION["id_user"];

        $success = DbAnnonce::addAnnonce($titre, $description, $date, $heure, $nb_place, $id_categorie, $id_user);

        if ($success) {
            header('Location: index.php?ctl=annonce&action=mesAnnonces');
            exit();
        } else {
            header('Location: index.php?ctl=annonce&action=addAnnonce&msg_erreur=Erreur lors de l\'ajout de l\'annonce');
            exit();
        }
        break;

    case 'deleteAnnonce':
        $id_annonce = $_POST["id_annonce"];
        DbAnnonce::deleteAnnonce($id_annonce);
        header('Location: index.php?ctl=annonce&action=vueAnnonces');
        break;

    case 'updateAnnonce':
        $id_annonce = $_POST["id_annonce"];
        $titre = $_POST["titre"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $heure = $_POST["heure"];
        $nb_place = $_POST["nb_place"];
        $id_categorie = $_POST["id_categorie"];
        DbAnnonce::editAnnonce($id_annonce, $titre, $description, $date, $heure, $nb_place, $id_categorie);
        header('Location: index.php?ctl=annonce&action=mesAnnonces');
        break;

    case 'accepterReservation':
        $id_reservation = $_POST['id_reservation'];
        DbAnnonce::updateReservationStatus($id_reservation, 'Accepté');
        $annonce = DbAnnonce::getAnnonceByReservation($id_reservation);
        DbAnnonce::decrementPlacesDisponibles($annonce['id_annonce']);
        header('Location: index.php?ctl=annonce&action=mesAnnonces');
        break;

}
?>
