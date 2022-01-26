<?php

$internship = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, ['IdInternship' => $_GET['id']])[0];

?>

<div id="internship">
    <div>
        <div>
            <div class="infos">
                <h1><?= $internship->getDesignation() ?></h1>
                <h2><?= $internship->getAuthor() ?></h2>
            </div>
            <form>
                <?php if (empty($_SESSION['CV'])): ?>
                    <input required type="file" name="CV" id="">
                <?php endif ?>
                <?php if (empty($_SESSION['LM'])): ?>
                    <input required type="file" name="LM" id="">
                <?php endif ?>

                <button>je suis intéressé</button>
            </form>
        </div>
        <p><?= $internship->getDescription() ?></p>
    </div>
</div>
