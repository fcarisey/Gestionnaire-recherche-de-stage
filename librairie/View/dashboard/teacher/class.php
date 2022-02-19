<?php

$subpage =  $_GET['subpage2'] ?? 'home';

switch ($subpage){
    case 'home': require_once('librairie/View/dashboard/teacher/class/home.php');break;
    case 'view': require_once('librairie/View/dashboard/teacher/class/view.php');break;
}

if (isset($_POST['ajax']))
    die;

?>
