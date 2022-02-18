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
        <h2>Administration</h2>
        <ul>
            <a data-subpage="home" href="#home">Accueil</a>

            <div id="class">
                <div>
                    <a data-subpage="class" href="#class">Classes</a>
                    <a></a>
                </div>
                <ul class="toggler submenu">
                    <a data-subpage="create" href="#create">Créer</a>
                </ul>
            </div>

            <div id="student">
                <div>
                    <a data-subpage="student" href="#student">Eleves</a>
                    <a></a>
                </div>
                <ul class="toggler submenu">
                    <a data-subpage="create" href="#create">Créer/Importer</a>
                </ul> 
            </div>
            
            <div id="teacher">
                <div>
                    <a data-subpage="teacher" href="#teacher">Profs</a>
                    <a></a>
                </div>
                <ul class="toggler submenu">
                    <a data-subpage="create" href="#create">Créer</a>
                </ul>
            </div>
            
            <div id="internship">
                <div>
                    <a data-subpage="internship" href="#internship">Stages</a>
                    <a></a>
                </div>
                <ul class="toggler submenu">
                    <a data-subpage="add" href="#add">Ajouter</a>
                </ul>
            </div>
        </ul>
    </nav>
    <div id="subpage">

    </div>
</div>
