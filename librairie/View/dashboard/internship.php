<?php

$subpage =  $_GET['subpage2'] ?? 'home';

switch ($subpage){
    case 'home': require_once('librairie/View/dashboard/internship/home.php');break;
    case 'create': require_once('librairie/View/dashboard/internship/create.php');break;
}

if (isset($_POST['ajax']))
    die;

?>
