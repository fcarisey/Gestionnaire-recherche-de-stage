<?php

$internships = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, null, 4);
$internships = [$internships[0], $internships[0], $internships[0], $internships[0]];

$x = 0;

?>

<div id="home">
    <div class="internshipsProposal">
        <h1>Proposition de stage</h1>
        <div class="internships">
        <?php foreach($internships as $internship): ?>
            <?php if ($x == 0): ?>
                <div>
            <?php endif ?>

            <?php $x++; ?>

            <div class="internship">
                <h2><?= $internship->getDesignation() ?></h2>
                <p><?= $internship->getDescription() ?></p>
                <p class="seeMore"><a href="./internship/<?= $internship->getIdInternship() ?>">Voir plus</a></p>
            </div>

            <?php if ($x == 2): $x = 0; ?>
                </div>
            <?php endif ?>
        <?php endforeach ?>
        </div>
            
        <p class="seeMore"><a href="/internships">Voir plus</a></p>
    </div>
</div>
