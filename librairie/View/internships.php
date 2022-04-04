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
                    <?php
                        $intersted = \Controller\InterestController::SELECT(\Database::SELECT_ALL, [
                            'idstudent' => $_SESSION['id'],
                            'AND' => \Database::WHERE_KEY,
                            'idinternship' => $internship->getIdinternship()
                        ]);
                    ?>

                    <?php if ($intersted): ?>
                        <div class="interested"></div>
                    <?php endif ?>
                    <div></div>
                    <h2><?= $internship->getDesignation() ?></h2>
                    <p><?= $internship->getShortdescription() ?></p>
                    <a class="btn" href="./internship/<?= $internship->getIdinternship() ?>">Voir plus</a>
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