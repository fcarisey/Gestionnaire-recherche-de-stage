<?php

(isset($_SESSION['Id'])) ? \Controller\ViewController::redirect("./") : null;

if (isset($_POST['ajax'])){
    echo json_encode(\Controller\UserController::login($_POST['username'], $_POST['password']));
    die;
}

?>

<div id="login">
    <form action="./login" method="post">
        <fieldset>
            <legend>Connexion</legend>
            <div>
                <label>
                    Courriel:
                    <input autocomplete="username" type="text" name="username" placeholder="Nom d'utilisateur" required>
                    <small id="usernameError"></small>
                </label>
                <label>
                    Mot de passe:
                    <input autocomplete="current-password" type="password" name="password" placeholder="Mot de passe" required>
                    <small id="passwordError"></small>
                </label>
            </div>
            <button type="button">Se connecter</button>
        </fieldset>
    </form>
</div>