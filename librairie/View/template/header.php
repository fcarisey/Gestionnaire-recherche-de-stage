<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <title>GRDS -- <?=$page?></title>
</head>
<body>
    <header>
        <div>
            <nav>
                <ul>
                    <li><a href="/"><img src="/picture/logo.png" alt="Logo"></a></li>
                    <div>
                        <?php if (isset($_SESSION['id'])): ?>
                            <li><a href="/logout">Déconnexion</a></li>
                        <?php else: ?>
                            <li><a href="/login">Connexion</a></li>
                            <li><a href="/login">Inscription</a></li>
                        <?php endif ?>
                    </div>
                </ul>
            </nav>
            <nav>
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section>
    