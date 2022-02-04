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

<style>
    #dashboard{
        display: flex;
    }

    #dashboard nav{
        width: 15%;
        background-color: #528AF4;
        border-radius: 0 10px 10px 0;
    }

    #dashboard nav h2{
        padding: 10px 20px;
        background-color: white;
        width: 60%;
        margin: auto;
        margin-top: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
    }

    #dashboard nav ul{
        display: flex;
        flex-direction: column;
    }

    #dashboard nav ul a{
        padding: 5px 10px;
        color: white;
        display: flex;
        align-items: center;
    }

    #dashboard nav ul a:hover{
        text-decoration: underline;
    }

    #dashboard nav ul ul a{
        background-color: #396ADA;
        padding-left: 20px;
    }

    #dashboard nav ul div div{
        display: flex;
        justify-content: space-between;
    }

    #dashboard nav ul div div *:first-child{
        width: 68%;
    }

    #dashboard nav > ul div div a:first-child::before{
        zoom: 75%;
        position: relative;
        left: -5px;
    }

    #dashboard nav > ul > a:first-child::before{
        content: url('/picture/home.svg');
        zoom: 75%;
        position: relative;
        left: -5px;
    }

    #dashboard nav > ul #class div a:first-child::before{
        content: url('/picture/class.svg');
    }

    #dashboard nav > ul #student div a:first-child::before{
        content: url('/picture/student.svg');
    }

    #dashboard nav > ul #internship div a:first-child::before{
        content: url('/picture/internship.svg');
    }

    #dashboard nav > ul #teacher div a:first-child::before{
        content: url('/picture/teacher.svg');
    }

    #dashboard nav > ul div > a:last-child::after {
        content: '▼';
        color: black;
        zoom: 120%;
        transition: transform 500ms;
    }

    #dashboard nav > ul div > a.active:last-child::after{
        transform: rotate(180deg);
    }

    #dashboard nav > ul div > a:last-child:hover{
        cursor: pointer;
        text-decoration: none;
    }

    #dashboard nav ul div .toggler{
        display: none;
    }

    #dashboard nav ul div .toggler.OK{
        display: flex;
    }
</style>

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
