<?php

$subpage =  $_GET['subpage2'] ?? 'home';

switch ($subpage){
    case 'home': require_once('librairie/View/dashboard/student/home.php');break;
}

if (isset($_POST['ajax']))
    die;

?>

