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
        <table id="internships-1">
            <tbody>
                <tr>
                <?php foreach ($internships as $internship): ?>
                    <td class="internship">
                        <h2><?= $internship->getDesignation() ?></h2>
                        <p><?= $internship->getShortdescription() ?></p>
                        <a class="btn" href="./internship/<?= $internship->getIdInternship() ?>">Voir plus</a>
                    </td>
                <?php endforeach ?>
                </tr>
            </tbody>
        </table>
        <p id="seeMore"><a href="/internships">Voir plus</a></p>
    <?php endif ?>
</div>
