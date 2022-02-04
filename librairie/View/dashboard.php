<?php

if (isset($_POST['ajax'])){
    $subpage = (isset($_GET['subpage'])) ? $_GET['subpage'] : 'home';

    switch ($subpage){
        case 'home' : require_once("librairie/View/dashboard/home.php");break;
        case 'class' : require_once("librairie/View/dashboard/class.php");break;
        case 'student' : require_once("librairie/View/dashboard/student.php");break;
        case 'internship' : require_once("librairie/View/dashboard/internship.php");break;
        case 'teacher' : require_once("librairie/View/dashboard/teacher.php");break;
    }

    die;
}

?>

<div id="dashboard">
    <nav>
        <ul>
            <li><a data-subpage="home" href="#home">Accueil</a></li>
            <li>
                <a data-subpage="class" href="#class">Classes</a>
                <ul>
                    <li><a data-subpage="create" href="#create">Créer</a></li>
                </ul>
            </li>
            <li>
                <a data-subpage="student" href="#student">Eleves</a>
                <ul>
                    <li><a data-subpage="create" href="#create">Créer/Importer</a></li>
                </ul>
            </li>
            <li>
                <a data-subpage="internship" href="#internship">Stages</a>
                <ul>
                    <li><a data-subpage="add" href="#add"></a>Ajouter</li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="subpage">

    </div>
</div>
