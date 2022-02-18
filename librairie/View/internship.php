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
}else{
    $internship = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, ['idinternship' => $_GET['id']])[0];

    $isinterest = \Controller\InterestController::SELECT(\Database::SELECT_ALL, [
        'idstudent' => $_SESSION['id'],
        'AND' => Database::WHERE_KEY,
        'idinternship' => $_GET['id']
    ], 1);

    ($isinterest) ? $isinterest = true : $isinterest = false;
}

?>

<div id="internship">
    <div>
        <div>
            <h2><?= $internship->getDesignation() ?></h2>
            <h3><?= $internship->getEnterprise() ?></h3>
        </div>

        <?php if (!$isinterest): ?>
            <input type="button" value="Je suis interessé">
        <?php else: ?>
            <input type="button" value="Je ne suis plus interessé" class="KO">
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
