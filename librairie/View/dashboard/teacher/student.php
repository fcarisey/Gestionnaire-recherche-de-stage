<?php

$subpage =  $_GET['subpage2'] ?? 'home';

switch ($subpage){
    case 'home': require_once('librairie/View/dashboard/teacher/student/home.php');break;
}

if (isset($_POST['ajax']))
    die;

?>

