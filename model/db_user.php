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
    
        $sql = "INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `name_valo`, `rank_valo`) 
                VALUES (NULL, ?, ?, ?, NULL, NULL)";
        
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
        $sql = "SELECT * FROM USER WHERE id_user = :id_user";
        $stmt = connectPdo::getObjPdo()->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}

?>