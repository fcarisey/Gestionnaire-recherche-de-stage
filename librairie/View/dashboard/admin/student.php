<?php

$subpage =  $_GET['subpage2'] ?? 'home';

switch ($subpage){
    case 'home': require_once('librairie/View/dashboard/admin/student/home.php');break;
    case 'add': require_once('librairie/View/dashboard/admin/student/addImport.php');break;
}

if (isset($_POST['ajax']))
    die;

?>

