<?php

if (isset($_POST['ajax']) && isset($_GET['subpage1'])){
    $subpage = $_GET['subpage1'] ?? 'home';

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
            <div class="home">
                <div>
                    <a data-subpage="home">Accueil</a>
                </div>
            </div>

            <div class="class">
                <div>
                    <a data-subpage="class">Classes</a>
                    <a></a>
                </div>
                <ul class="toggler submenu">
                    <a data-subpage="class/create">Créer</a>
                </ul>
            </div>

            <div class="student">
                <div>
                    <a data-subpage="student">Eleves</a>
                    <a></a>
                </div>
                <ul class="toggler submenu">
                    <a data-subpage="student/add">Ajouter/Importer</a>
                </ul> 
            </div>
            
            <div class="teacher">
                <div>
                    <a data-subpage="teacher">Profs</a>
                    <a></a>
                </div>
                <ul class="toggler submenu">
                    <a data-subpage="teacher/add">Ajouter</a>
                </ul>
            </div>
            
            <div class="internship">
                <div>
                    <a data-subpage="internship">Stages</a>
                    <a></a>
                </div>
                <ul class="toggler submenu">
                    <a data-subpage="internship/create">Créer</a>
                </ul>
            </div>
        </ul>
    </nav>
    <div id="subpage">
        <?php
            $subpage = (isset($_GET['subpage1'])) ? $_GET['subpage1'] : 'home';

            switch ($subpage){
                case 'home' : require_once("librairie/View/dashboard/home.php");break;
                case 'class' : require_once("librairie/View/dashboard/class.php");break;
                case 'student' : require_once("librairie/View/dashboard/student.php");break;
                case 'internship' : require_once("librairie/View/dashboard/internship.php");break;
                case 'teacher' : require_once("librairie/View/dashboard/teacher.php");break;
            }
        ?>
    </div>
</div>
