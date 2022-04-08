<?php

(isset($_SESSION['id'])) ? \Controller\ViewController::redirect("./") : null;

if (isset($_POST['ajax'])){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $err = Controller\StudentController::login($username, $password);
    $err = array_merge($err, Controller\TeacherController::login($username, $password));
    $err = array_merge($err, Controller\AdminController::login($username, $password));

    echo json_encode($err);
    die;
}

?>

<div id="login">
    <form name="login" method="post" action="./login" onsubmit="login(event, this)">
        <h2>Connexion</h2>
        <div>
            <label>
                Nom d'utilisateur:
                <input autocomplete="off" class="mandatory" type="text" name="username" placeholder="Nom d'utilisateur" required>
                <small class="inputError" id="usernameError"></small>
            </label>
            <label>
                Mot de passe:
                <input minlength="8" class="mandatory" autocomplete="current-password" type="password" name="password" placeholder="Mot de passe" required>
                <small class="inputError" id="passwordError"></small>
            </label>
        </div>
        <button class="btn">Se connecter</button>
        <small id="accountError"></small>
    </form>
</div>
