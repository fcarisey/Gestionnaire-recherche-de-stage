<?php 

if (isset($_POST['ajax'])){
    $object = htmlspecialchars($_POST['object']);
    $email = htmlspecialchars(isset($_SESSION['id']) ? $_SESSION['courriel'] : $_POST['courriel']);
    $message = htmlspecialchars($_POST['message']);

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
        $err['courriel'] = "Veuillez renseignez une adresse mail ou vous connecter.";

    $messageParse = false;
    if (!empty($message)){
        $messageParse = true;
    }else
        $err['message'] = "Le message est obligatoire !";

    if ($objectParse && $emailParse && $messageParse){
        Controller\MailController::sendMailTo("fcarisey6@gmail.com", $object, $message, $message, true, $email);
        $err['valide'] = "Merci, votre message à bien été envoyé !";
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
                <input required autocomplete="off" type="text" name="object" placeholder="Objet">
                <small id="objectError"></small>
            </label>
            <?php if (!isset($_SESSION['Id'])): ?>
                <label>
                    Courriel:
                    <input required type="email" name="courriel" placeholder="Courriel">
                    <small id="courrielError"></small>
                </label>
                
            <?php endif ?>
        </div>
        <label>
            Message:
            <textarea required name="Message" rows="5" cols="50" placeholder="Message"></textarea>
            <small id="messageError"></small>
        </label>
        <div>
            <button type="button">Envoyer</button>
            <p id="valide"></p>
        </div>
        
    </form>
<div>
