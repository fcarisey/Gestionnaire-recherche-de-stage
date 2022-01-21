<?php 

if (isset($_POST['ajax'])){
    $object = $_POST['object'];
    $email = isset($_SESSION['id']) ? $_SESSION['courriel'] : $_POST['courriel'] ;
    $message = $_POST['message'];

    $err = [];

    $objectParse = false;
    if (!empty($object)){
        $objectParse = true;
    }else
        $err['object'] = "L'objet du mail est obligatoire !";

    $emailParse = false;
    if (!empty($email)){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailParse = true;
        }else
            $err['courriel'] = "L'adresse mail n'est pas valide !";
    }else
        $err['courriel'] = "Veuillez renseignez une adresse mail ou vous connecter !";

    $messageParse = false;
    if (!empty($message)){
        $messageParse = true;
    }else
        $err['message'] = "Le message est obligatoire !";

    if ($objectParse && $emailParse && $messageParse){
        Controller\MailController::sendMailTo("fcarisey6@gmail.com", $object, $message, $message, true, $email);
        $err['valide'] = "Votre message à bien été envoyé !";
    }

    echo json_encode($err);
    die;
}

?>

<div id="contact">
    <form method="post" action="./">
        <div>
            <label>
                Objet:
                <input required autocomplete="off" type="text" name="object">
                <small id="object"></small>
            </label>
            <?php if (!isset($_SESSION['id'])): ?>
                <label>
                    Courriel:
                    <input type="mail" name="courriel">
                    <small id="courriel"></small>
                </label>
                
            <?php endif ?>
        </div>
        <label>
            Message:
            <textarea required name="message" rows="5" cols="50"></textarea>
            <small id="message"></small>
        </label>
        <button type="button">Envoyer</button>
    </form>
<div>
