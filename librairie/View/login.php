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
    <form name="login" action="./login" method="post">
        <h2>Connexion</h2>
        <div>
            <label>
                Nom d'utilisateur:
                <input autocomplete="off" type="text" name="username" placeholder="Nom d'utilisateur" required>
                <small id="usernameError"></small>
            </label>
            <label>
                Mot de passe:
                <input minlength="8" autocomplete="current-password" type="password" name="password" placeholder="Mot de passe" required>
                <small id="passwordError"></small>
            </label>
        </div>
        <button class="btn">Se connecter</button>
        <small id="accountError"></small>
    </form>
</div>
