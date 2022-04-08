<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="shortcut icon" href="/picture/favicon.ico" type="image/x-icon">
    <title>GRDS -- <?=$page?></title>
</head>
<body>
    <header>
        <div>
            <nav>
                <ul>
                    <li><a href="/"><img src="/picture/logo.png" alt="Logo"></a></li>
                    <div>
                        <?php

                        if (isset($_SESSION['id'])): ?>
                            <li><a href="/account">Mon compte</a></li>
                            <li><a href="/logout">Déconnexion</a></li>
                        <?php else: ?>
                            <li><a href="/login">Connexion</a></li>
                        <?php endif ?>
                    </div>
                </ul>
            </nav>
            <nav>
                <ul>
                    <li><a <?= ($page == "home") ? 'class="active"' : null ?> href="/">Accueil</a></li>
                    <?php if (isset($_SESSION['id']) && Controller\ControllerController::keyExist('role', $_SESSION) == "Student"): ?>
                        <li><a <?= (($page == "internships") || ($page == 'internship')) ? 'class="active"' : null ?> href="/internships">Stages</a></li>
                    <?php endif ?>
                    <?php if (Controller\ControllerController::keyExist('role', $_SESSION) == "Teacher" || Controller\ControllerController::keyExist('role', $_SESSION) == "Admin") : ?>
                        <li><a <?= (($page == "dashboard")) ? 'class="active"' : null ?> href="/dashboard">Dashboard</a></li>
                    <?php endif ?>
                    <li><a <?= ($page == "contact") ? 'class="active"' : null ?> href="/contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section>
    