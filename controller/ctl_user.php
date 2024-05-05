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
}

?>