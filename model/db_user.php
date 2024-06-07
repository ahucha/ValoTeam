<?php
include 'connectPdo.php';

class DbUser
{
    public static function isUsernameTaken($username) {
        $sql = "SELECT COUNT(*) FROM `user` WHERE `username` = ?";
        $stmt = connectPdo::getObjPdo()->prepare($sql);
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        return $count > 0;

    }

    public static function isEmailTaken($email) {
        $sql = "SELECT COUNT(*) FROM `user` WHERE `email` = ?";
        $stmt = connectPdo::getObjPdo()->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }

    //Login
    public static function validAjout($username, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `name_valo`, `rank_valo`, `id_role`) 
                VALUES (NULL, ?, ?, ?, NULL, NULL,2)";
        
        $stmt = connectPdo::getObjPdo()->prepare($sql);
        $stmt->execute([$username, $email, $hashedPassword]);
    }

    public static function getUserByUsername($username)
    {
        $sql = "SELECT * FROM `user` WHERE `username` = ?";
        $stmt = connectPdo::getObjPdo()->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function getUser($username, $password)
    {
        $user = static::getUserByUsername($username);

        if ($user && password_verify($password, $user['password']))
        {
            return $user;
        }
            else
        {
            return false;
        }
    }

    public static function getInfoUser($id_user)
    {
        $sql = "SELECT * FROM user WHERE id_user = :id_user";
        $stmt = connectPdo::getObjPdo()->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getListeUser()
    {
        $sql = "SELECT * FROM user JOIN role ON role.id_role = user.id_role";
        $stmt = connectPdo::getObjPdo()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function deleteUser($id_user)
    {
        $sql = "DELETE FROM user WHERE id_user = :id_user";
        $conn = connectPdo::getObjPdo();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->execute();
    }


    public static function updateUser($id_user,$username, $email, $name_valo, $rank_valo)
    {
        $sql = "UPDATE user SET username = :username, email = :email, name_valo = :name_valo, rank_valo = :rank_valo WHERE id_user = :id_user";
        $conn = connectPdo::getObjPdo();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":name_valo", $name_valo, PDO::PARAM_STR);
        $stmt->bindParam(":rank_valo", $rank_valo, PDO::PARAM_STR);
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>