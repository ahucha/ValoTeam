<h1>VUE PROFIL</h1>
<?php
// Assurez-vous que $infoUser est défini avant de l'utiliser
if(isset($infoUser)) {
    foreach($infoUser as $user) 
    {
        echo "username: " . $user['username'] . "<br>";
        echo "email: " . $user['email'] . "<br>";
    }
}
?>