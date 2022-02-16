<?php

$internships = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, null);
$internships = [$internships[0], $internships[0], $internships[0]];

$x = 0;

?>

<div id="internships">
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
</div>