<?php

$subpage =  $_GET['subpage2'] ?? 'home';

switch ($subpage){
    case 'home': require_once('librairie/View/dashboard/admin/class/home.php');break;
    case 'create': require_once('librairie/View/dashboard/admin/class/create.php');break;
}

if (isset($_POST['ajax']))
    die;

?>