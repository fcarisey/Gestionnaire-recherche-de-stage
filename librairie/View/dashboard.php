<?php

if (isset($_POST['ajax']) && isset($_GET['subpage1'])){
    $subpage = $_GET['subpage1'] ?? 'home';

    if ($_SESSION['role'] == "Teacher"){
        switch ($subpage){
            case 'home' : require_once("librairie/View/dashboard/teacher/home.php");break;
            case 'class' : require_once("librairie/View/dashboard/teacher/class.php");break;
            case 'student' : require_once("librairie/View/dashboard/teacher/student.php");break;
            case 'internship' : require_once("librairie/View/dashboard/teacher/internship.php");break;
            case 'teacher' : require_once("librairie/View/dashboard/teacher/teacher.php");break;
        }
    }else{
        switch ($subpage){
            case 'home' : require_once("librairie/View/dashboard/admin/home.php");break;
            case 'class' : require_once("librairie/View/dashboard/admin/class.php");break;
            case 'student' : require_once("librairie/View/dashboard/admin/student.php");break;
            case 'teacher' : require_once("librairie/View/dashboard/admin/teacher.php");break;
        }
    }

    die;
}

$classes = [];
if ($_SESSION['role'] == "Teacher"){
    $affiliates = \Controller\AffiliateController::SELECT(['idclasse'], ['idteacher' => $_SESSION['id']]);
    if ($affiliates){
        foreach ($affiliates as $affiliate){
            $classes = array_merge($classes, \Controller\ClasseController::SELECT(\Database::SELECT_ALL, ['idclasse' => $affiliate->getIdclasse()]));
        }
    }
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
                <?php if ($_SESSION['role'] == 'Admin'): ?>
                    <ul class="toggler submenu">
                        <a data-subpage="class/create">Créer</a>
                    </ul>
                <?php endif ?>

                <?php foreach ($classes as $classe): ?>
                    <ul class="toggler submenu">
                        <a data-subpage="class/view/<?= $classe->getDesignation() ?>"><?= $classe->getDesignation() ?></a>
                    </ul>
                <?php endforeach ?>
            </div>

            <div class="student">
                <div>
                    <a data-subpage="student">Eleves</a>
                    <?php if ($_SESSION['role'] == 'Admin'): ?>
                        <a></a>
                    <?php endif ?>
                </div>

                <?php if ($_SESSION['role'] == 'Admin'): ?>
                    <ul class="toggler submenu">
                        <a data-subpage="student/add">Ajouter/Importer</a>
                    </ul>
                <?php endif ?>

            </div>
            
            <?php if ($_SESSION['role'] == 'Admin'): ?>
                <div class="teacher">
                    <div>
                        <a data-subpage="teacher">Profs</a>
                        <?php if ($_SESSION['role'] == 'Admin'): ?>
                            <a></a>
                        <?php endif ?>
                    </div>
                    <ul class="toggler submenu">
                        <a data-subpage="teacher/add">Ajouter</a>
                    </ul>
                </div>
            <?php endif ?>
            
            <?php if ($_SESSION['role'] == 'Teacher'): ?>
                <div class="internship">
                    <div>
                        <a data-subpage="internship">Stages</a>
                        <a></a>
                    </div>
                    <ul class="toggler submenu">
                        <a data-subpage="internship/create">Créer</a>
                    </ul>
                </div>
            <?php endif ?>
        </ul>
    </nav>
    <div id="subpage">
        <?php
            $subpage = (isset($_GET['subpage1'])) ? $_GET['subpage1'] : 'home';

            if ($_SESSION['role'] == "Teacher"){
                switch ($subpage){
                    case 'home' : require_once("librairie/View/dashboard/teacher/home.php");break;
                    case 'class' : require_once("librairie/View/dashboard/teacher/class.php");break;
                    case 'student' : require_once("librairie/View/dashboard/teacher/student.php");break;
                    case 'internship' : require_once("librairie/View/dashboard/teacher/internship.php");break;
                    case 'teacher' : require_once("librairie/View/dashboard/teacher/teacher.php");break;
                }
            }else{
                switch ($subpage){
                    case 'home' : require_once("librairie/View/dashboard/admin/home.php");break;
                    case 'class' : require_once("librairie/View/dashboard/admin/class.php");break;
                    case 'student' : require_once("librairie/View/dashboard/admin/student.php");break;
                    case 'internship' : require_once("librairie/View/dashboard/admin/internship.php");break;
                    case 'teacher' : require_once("librairie/View/dashboard/admin/teacher.php");break;
                }
            }
        ?>
    </div>
</div>
