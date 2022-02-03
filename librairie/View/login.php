<?php

(isset($_SESSION['Id'])) ? \Controller\ViewController::redirect("./") : null;

if (isset($_POST['ajax'])){
    $err = Controller\StudentController::login($_POST['username'], $_POST['password']);
    $err = array_merge($err, Controller\TeacherController::login($_POST['username'], $_POST['password']));
    $err = array_merge($err, Controller\AdminController::login($_POST['username'], $_POST ('password')));

    echo json_encode($err);
    die;
}

?>

<div id="login">
    <form action="./login" method="post">
        <fieldset>
            <legend>Connexion</legend>
            <div>
                <label>
                    Nom d'utilisateur:
                    <input autocomplete="off" type="text" name="username" placeholder="Nom d'utilisateur" required>
                    <small id="usernameError"></small>
                </label>
                <label>
                    Mot de passe:
                    <input autocomplete="current-password" type="password" name="password" placeholder="Mot de passe" required>
                    <small id="passwordError"></small>
                </label>
            </div>
            <button type="button">Se connecter</button>
            <small id="accountError"></small>
        </fieldset>
    </form>
</div>