<?php

$internship = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, ['IdInternship' => $_GET['id']])[0];

?>

<div id="internship">
    <div>
        <div>
            <h2><?= $internship->getDesignation() ?></h2>
            <form>
                <?php if (empty($_SESSION['CV'])): ?>
                    <label>
                        CV:
                        <input required type="file" name="CV">
                    </label>
                <?php endif ?>
                <?php if (empty($_SESSION['LM'])): ?>
                    <label>
                        LM: 
                        <input required type="file" name="LM">
                    </label>
                <?php endif ?>
                
                <button type="button">Je suis interésser</button>
            </form>
        </div>
        <div>
			<?= $internship->getDescription() ?>
        </div>
    </div>
</div>
