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
        <table id="internships-1">
            <tbody>
                <?php foreach ($internships as $internship): ?>
                    <?php if ($x == 0): ?>
                        <tr>
                    <?php endif ?>

                    <td class="internship">
                        <h2><?= $internship->getDesignation() ?></h2>
                        <p><?= $internship->getShortdescription() ?></p>
                        <a class="btn" href="./internship/modify/<?= $internship->getIdInternship() ?>">Modifier</a>
                    </td>
                    
                    <?php $x++; ?>
                    <?php if ($x == 2): ?>
                        <?php $x = 0; ?>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>