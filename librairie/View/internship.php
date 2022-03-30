<?php

if (isset($_POST['ajax'])){
    $type = $_POST['type'];

    $err = [];

    if ($type == 'i'){
        \Controller\InterestController::INSERT([
            'idstudent' => (int)$_SESSION['id'],
            'idinternship' => (int)$_GET['id']
        ]);

        $err['text'] = "Je ne suis plus interessé";

    }else{
        \Controller\InterestController::DELETE([
            'idstudent' => (int)$_SESSION['id'],
            'AND' => \Database::WHERE_KEY,
            'idinternship' => (int)$_GET['id']
        ]);

        $err['text'] = "Je suis interessé";
    }

    $err['valide'] = true;

    echo json_encode($err);
    die;
}

$internship = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, ['idinternship' => $_GET['id']])[0];

$idClass = unserialize($_SESSION['classe'])->getIdclasse();

if ($internship->getIdClasse() != $idClass){
    header("location:javascript://history.go(-1)");
    die;
}

$isinterest = \Controller\InterestController::SELECT(\Database::SELECT_ALL, [
    'idstudent' => $_SESSION['id'],
    'AND' => Database::WHERE_KEY,
    'idinternship' => $_GET['id']
], 1);

($isinterest) ? $isinterest = true : $isinterest = false;

?>

<style>
    #internship {
        display: flex;
        width: 90%;
        margin: auto;
    }

    #internship > div {
        display: flex;
        flex-direction: column;
        width: 50%;
        height: 250px;
        justify-content: space-between;
    }

    #internship > div > div:first-child h2{
        color: #403e83;
    }

    #internship > div > div:first-child h3{
        color: gray;
        margin-top: 5px;
    }

    #internship > div input {
        margin: auto;
        padding: 10px;
        margin-left: 10%;
        transition: background 200ms;
    }

    #internship > div input.KO {
        border: 1px solid #DA3939;
        color: #DA3939;
    }

    #internship > div input.KO:hover {
        background-color: rgba(219, 57, 57, 0.25);
    }

    #internship > p {
        text-align: justify;
        width: 100%;
    }
</style>

<div id="internship">
    <div>
        <div>
            <h2><?= $internship->getDesignation() ?></h2>
            <h3><?= $internship->getEnterprise() ?></h3>
        </div>

        <?php if (!$isinterest): ?>
            <input type="button" value="Je suis interessé" class="btn">
        <?php else: ?>
            <input type="button" value="Je ne suis plus interessé" class="btn KO">
        <?php endif ?>
        
        <div>
            <p>Site web: <a href="<?= $internship->getWebsite() ?>"><?= $internship->getWebsite() ?></a></p>
            <p>Téléphone: <a href="tel:<?= $internship->getPhone() ?>"><?= $internship->getPhone() ?></a></p>
            <p>Courriel: <a href="mail:<?= $internship->getEmail() ?>"><?= $internship->getEmail() ?></a></p>
        </div>
    </div>
    <p>
        <?= $internship->getDescription() ?>
    </p>
</div>
