<?php

$classId = \Controller\AffiliateController::SELECT(['idclasse'], [
    'idteacher' => $_SESSION['id']
])[0]->getIdclasse();

$internships = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, [
    'idclasse' => $classId,
    'AND' => Database::WHERE_KEY,
    'isdone' => 0
]);

$x = 0;

?>

<div id="dt_internships_home">
    <?php if ($internships): ?>
        <div class="internships">
            <div>
            <?php foreach($internships as $internship): ?>
                <?php if ($x == 0): ?>
                    <div>
                <?php endif ?>
                <div class="internship">
                    <h2><?= $internship->getDesignation() ?></h2>
                    <p><?= $internship->getShortdescription() ?></p>
                    <p class="seeMore"><a class="btn" href="./internship/modify/<?= $internship->getIdInternship() ?>">Voir plus</a></p>
                </div>
                <?php $x++; ?>
                <?php if ($x == 2): ?>
                    <?php $x = 0; ?>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>
</div>