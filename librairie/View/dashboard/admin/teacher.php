<?php

$subpage =  $_GET['subpage2'] ?? 'home';

switch ($subpage){
    case 'home': require_once('librairie/View/dashboard/admin/teacher/home.php');break;
    case 'add': require_once('librairie/View/dashboard/admin/teacher/add.php');break;
    case 'modify': require_once('librairie/View/dashboard/admin/teacher/modify.php');break;
}

if (isset($_POST['ajax']))
    die;

?>