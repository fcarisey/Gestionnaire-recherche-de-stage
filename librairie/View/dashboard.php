<?php

$subpage = (isset($_GET['subpage'])) ? $_GET['subpage'] : 'home';

switch ($subpage){
    case 'home' : require_once("librairie/View/dashboard/home.php");break;
}

?>

<h2>dashboard</h2>