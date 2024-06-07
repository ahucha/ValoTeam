<?php
include 'connectPdo.php';

class DbAnnonce
{
    public static function getListeCategories()
    {
        $sql = "SELECT id_categorie, libelle_categorie FROM categorie";
        $stmt = connectPdo::getObjPdo()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } 

    public static function addAnnonce($titre, $description, $date, $heure, $nb_place, $id_categorie, $id_user) {
        $statut = 'en cours';
        $query = "INSERT INTO annonce (titre, description, date, heure, nb_place, statut, id_categorie, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        return $stmt->execute([$titre, $description, $date, $heure, $nb_place, $statut, $id_categorie, $id_user]);
    }

    public static function getAllAnnonces($userId) {
        $query = "
            SELECT a.*, c.libelle_categorie, u.username,
            CASE WHEN r.id_reservation IS NULL THEN 0 ELSE 1 END AS reserved
            FROM annonce a
            JOIN categorie c ON a.id_categorie = c.id_categorie
            JOIN user u ON a.id_user = u.id_user
            LEFT JOIN reservation r ON a.id_annonce = r.id_annonce AND r.id_user = ?
            WHERE a.id_user != ? 
            AND a.nb_place > 0
        ";
        
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$userId, $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public static function getAnnoncesByCategory($categoryId, $userId) {
        $query = "
            SELECT a.*, c.libelle_categorie, u.username,
            CASE WHEN r.id_reservation IS NULL THEN 0 ELSE 1 END AS reserved
            FROM annonce a
            JOIN categorie c ON a.id_categorie = c.id_categorie
            JOIN user u ON a.id_user = u.id_user
            LEFT JOIN reservation r ON a.id_annonce = r.id_annonce AND r.id_user = ?
            WHERE a.id_categorie = ? AND a.id_user != ? 
            AND a.nb_place > 0
        ";
        
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$userId, $categoryId, $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAcceptedUsersForReservation($reservationId) {
        $query = "
            SELECT u.name_valo, u.rank_valo
            FROM reservation r
            JOIN user u ON r.id_user = u.id_user
            WHERE r.id_reservation = ? AND r.statut = 'Accepté'
        ";
        
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$reservationId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    public static function getAllCategories() {
        $query = "SELECT * FROM categorie";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function deleteAnnonce($id_annonce) {
        $query = "DELETE FROM annonce WHERE id_annonce = ?";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$id_annonce]);
    }

    public static function getAnnoncesByUser($id_user) {
        $query = "SELECT annonce.*, categorie.libelle_categorie, user.username
                  FROM annonce 
                  JOIN categorie ON annonce.id_categorie = categorie.id_categorie
                  JOIN user ON annonce.id_user = user.id_user
                  WHERE annonce.id_user = ?";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function editAnnonce($id_annonce, $titre, $description, $date, $heure, $nb_place, $id_categorie) {
        $query = "UPDATE annonce 
                  SET titre = ?, description = ?, date = ?, heure = ?, nb_place = ?, id_categorie = ? 
                  WHERE id_annonce = ?";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        return $stmt->execute([$titre, $description, $date, $heure, $nb_place, $id_categorie, $id_annonce]);
    }

    public static function getReservationsByAnnonce($id_annonce) {
        $query = "SELECT r.*, u.name_valo, u.rank_valo 
                  FROM reservation r
                  INNER JOIN user u ON r.id_user = u.id_user
                  WHERE r.id_annonce = ? AND r.statut != 'Refusé'";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$id_annonce]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function decrementPlacesDisponibles($id_annonce) {
        $query = "UPDATE annonce SET nb_place = nb_place - 1 WHERE id_annonce = ?";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$id_annonce]);
    }

    public static function getAnnonceByReservation($id_reservation) {
        $query = "SELECT a.* FROM annonce a
                  INNER JOIN reservation r ON a.id_annonce = r.id_annonce
                  WHERE r.id_reservation = ?";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$id_reservation]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateReservationStatus($id_reservation, $statut) {
        $query = "UPDATE reservation SET statut = ? WHERE id_reservation = ?";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$statut, $id_reservation]);
    }
    
    
    
}
?>
