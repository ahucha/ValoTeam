<?php
$action =$_GET['action'];

switch($action)
{
    case 'vueAnnonces':
        include 'view/view_annonce/annonces.php';
        break;
}
?>
