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
    <table id="internships-1">
        <tbody>
            <?php foreach ($internships as $internship): ?>
                <?php if ($x == 0): ?>
                    <tr>
                <?php endif ?>

                <td class="internship">
                    <h2><?= $internship->getDesignation() ?></h2>
                    <p><?= $internship->getShortdescription() ?></p>
                    <a class="btn" href="./internship/<?= $internship->getIdInternship() ?>">Voir plus</a>
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