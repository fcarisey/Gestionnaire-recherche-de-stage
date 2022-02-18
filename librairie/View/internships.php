<?php

$where = [
    'idclasse' => (int)unserialize($_SESSION['classe'])->getIdclasse(),
    'AND' => Database::WHERE_KEY,
    'isdone' => 0
];

$internships = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, $where);

$x = 0;

?>

<div id="internships">
    <?php if ($internships): ?>
        <div class="internships">
            <div>
            <?php foreach($internships as $internship): ?>
                <?php if ($x == 0): ?>
                    <div>
                <?php endif ?>
                <div class="internship">
                    <h2><?= $internship->getDesignation() ?></h2>
                    <p><?= $internship->getDescription() ?></p>
                    <p class="seeMore"><a href="./internship/<?= $internship->getIdInternship() ?>">Voir plus</a></p>
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