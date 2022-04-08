<style>
    #account{
       display: flex;
    }

    #account #menu{
        width: 25%;
    }

    #account #menu #pp{
        width: 100px;
        height: 100px;
        border-radius: 15px;
        margin-left: calc(50% - 50px);
    }

    #account #menu nav{
        padding: 50px 5px;
    }

    #account #menu nav h2{
        margin-left: 100px;
    }

    #account #menu_items{
        width: fit-content;
        margin-left: 125px;
        margin-top: 50px;
    }

    #account .items_item a{
        text-decoration: underline;
        color: #187074;
    }
    
</style>

<div id="account">
    <div id="menu">
        <img id="pp" src="//via.placeholder.com/100" alt="PP">
        <nav>
            <h2>NOM Prenom</h2>
            <ul id="menu_items">
                <li class="items_item"><a href="/account">Accueil</a></li>
                <li class="items_item"><a href="/account/files">Fichiers</a></li>
                <li class="items_item"><a href="/account/settings">Paramètres</a></li>
                <li class="items_item"><a href="/logout">Deconnexion</a></li>
            </ul>
        </nav>
    </div>
    <div id="subpage">
        <?php

            $subpage = (isset($_GET['subpage'])) ? $_GET['subpage'] : 'home';

            if ($_SESSION['role'] == "Student"){
                switch ($subpage) {
                    case 'files': require_once("librairie/View/account/student/files.php"); break;
                    case 'settings': require_once("librairie/View/account/student/settings.php"); break;
                    default: require_once("librairie/View/account/student/home.php"); break;
                }
            }else{
                switch ($subpage) {
                    default: require_once("librairie/View/account/student/home.php"); break;
                }
            }

        ?>
    </div>
</div>