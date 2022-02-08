<?php

$internship = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, ['idinternship' => $_GET['id']])[0];

if (isset($_SESSION['id'])){
    $isinterest = \Controller\InterestController::SELECT(\Database::SELECT_ALL, [
        'idstudent' => $_SESSION['id'],
        'idinternship' => $_GET['id']
    ], 1);

    ($isinterest) ? (($isinterest[0]) ? $isinterest = true : $isinterest = false) : null;
}


?>

<div id="internship">
    <div>
        <div>
            <div class="infos">
                <h1><?= $internship->getDesignation() ?></h1>
                <h2><?= $internship->getEnterprise() ?></h2>
            </div>
            <?php if (isset($_SESSION['id'])): ?>
                <?php if ($isinterest): ?>
                    <button class="OK">je suis intéressé</button>
                <?php else: ?>
                    <button class="KO">Je ne suis plus intéressé</button>
                <?php endif ?>
            <?php endif ?>
        </div>
        <p><?= $internship->getDescription() ?></p>
    </div>
</div>
