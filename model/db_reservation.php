<?php

include 'connectPdo.php';

class DbReservation
{
    public static function addReservation($id_user, $id_annonce, $statut)
    {
        $sql = "INSERT INTO reservation (id_user, id_annonce, statut) VALUES (?, ?, ?)";
        $stmt = connectPdo::getObjPdo()->prepare($sql);
        return $stmt->execute([$id_user, $id_annonce, $statut]);
    }
    
    public static function refuserReservation($id_reservation) 
    {
        $query = "UPDATE reservation SET statut = 'Refusé' WHERE id_reservation = ?";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$id_reservation]);
    }

    public static function updateReservationStatus($id_reservation, $statut) {
        $query = "UPDATE reservation SET statut = ? WHERE id_reservation = ?";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$statut, $id_reservation]);
    }

    public static function getUserReservations($userId) {
        $query = "
            SELECT r.*, a.titre, u.username, u.name_valo, a.id_user AS annonceur_id
            FROM reservation r
            JOIN annonce a ON r.id_annonce = a.id_annonce
            JOIN user u ON a.id_user = u.id_user
            WHERE r.id_user = ?
        ";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function supprimerReservation($id_reservation) {
        $query = "DELETE FROM reservation WHERE id_reservation = ?";
        $stmt = connectPdo::getObjPdo()->prepare($query);
        $stmt->execute([$id_reservation]);
    }

    public static function incrementNbPlaces($id_annonce)
    {
        $sql = "UPDATE annonce SET nb_place = nb_place + 1 WHERE id_annonce = ?";
        $stmt = connectPdo::getObjPdo()->prepare($sql);
        return $stmt->execute([$id_annonce]);
    }  
}

?>
