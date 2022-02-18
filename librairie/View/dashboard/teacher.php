<?php

$subpage =  $_GET['subpage2'] ?? 'home';

switch ($subpage){
    case 'home': require_once('librairie/View/dashboard/teacher/home.php');break;
    case 'add': require_once('librairie/View/dashboard/teacher/add.php');break;
}

if (isset($_POST['ajax']))
    die;

?>