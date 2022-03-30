<?php

if (isset($_SESSION['id']) && $_SESSION['role'] == "Student"){
    $where = [
        'idclasse' => (int)unserialize($_SESSION['classe'])->getIdclasse(),
        'AND' => Database::WHERE_KEY,
        'isdone' => 0
    ];
    
    $internships = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, $where, 2);
}

?>

<style>
    .internship{
        margin: 0 5px;
    }
</style>

<div id="home">
    <?php if (isset($_SESSION['id'], $internships)): ?>
        <?php if ($internships): ?>
            <div class="internshipsProposal">
                <h1>Proposition de stage</h1>
                <div class="internships">
                    <?php foreach($internships as $internship): ?>
                        <div class="internship">
                            <h2><?= $internship->getDesignation() ?></h2>
                            <p><?= $internship->getshortdescription() ?></p>
                            <p class="seeMore"><a class="btn" href="./internship/<?= $internship->getIdInternship() ?>">Voir plus</a></p>
                        </div>
                    <?php endforeach ?>
                </div>
                <p class="seeMore"><a href="/internships">Voir plus</a></p>
            </div>
        <?php endif ?>
    <?php endif ?>
</div>
