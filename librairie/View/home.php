<?php

$internships = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, null);
$internships = [$internships[0], $internships[0]];

?>

<div id="home">
    <div class="internshipsProposal">
        <h1>Proposition de stage</h1>
        <div class="internships">
            <div>
            <?php foreach($internships as $internship): ?>
                <div class="internship">
                    <h2><?= $internship->getDesignation() ?></h2>
                    <p><?= $internship->getDescription() ?></p>
                    <p class="seeMore"><a href="./internship/<?= $internship->getIdInternship() ?>">Voir plus</a></p>
                </div>
            <?php endforeach ?>
            </div>
        </div>

        <p class="seeMore"><a href="/internships">Voir plus</a></p>
    </div>
</div>
