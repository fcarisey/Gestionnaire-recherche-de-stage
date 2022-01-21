<?php

namespace Controller;

class ViewController{
    public static function process(){
        $page = (isset($_GET['page'])) ? $_GET['page'] : 'home';
        self::userPermission($page);

        if (!isset($_POST['ajax']))
            require_once("librairie/View/template/header.php");

        switch($page){
            case 'home': require_once("librairie/View/home.php");break;
            case 'login': require_once("librairie/View/login.php");break;
            case 'contact': require_once("librairie/View/contact.php");break;
            case 'internships': require_once("librairie/View/internships.php");break;
            case 'logout': require_once("librairie/View/logout.php");break;
            case 'dashboard': require_once("librairie/View/dashboard.php");break;
        }

        if (!isset($_POST['ajax']))
            require_once("librairie/View/template/footer.php");
    }

    public static function userPermission($page){
        $basic = ['home', 'login', 'contact', 'logout'];
        
        $login = [];
        $eleve = array_merge(['internships'], $login);
        $administrator = array_merge(['dashboard'], $login);
        
        $allow = false;
        if (!in_array($page, $basic)){
            if (isset($_SESSION['id'])){

                if ($_SESSION['role'] == "eleve")
                    if (in_array($page, $eleve))
                        $allow = true;

                if ($_SESSION['role'] == "administrateur")
                    if (in_array($page, $administrator))
                        $allow = true;
            }
        }else
            $allow = true;

        if ($allow)
            return true;
        else{
            require_once("error/401.html");
            die;
        }
    }

    public static function redirect($location){
        header("Location: $location", true);
        die;
    }
}

?>
