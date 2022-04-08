<?php

$teachers = \Controller\TeacherController::SELECT(\Database::SELECT_ALL);

?>

<style>
    #da_teacher_home table{
        width: 50%;
        margin: auto;
    }

    #da_teacher_home thead th{
        border-bottom: 2px solid gray;
    }

    #da_teacher_home tbody td{
        text-align: center;
    }

    #da_teacher_home tfoot th{
        border-top: 2px solid gray;
    }
</style>

<div id="da_teacher_home">
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Nom d'utilisateur</th>
                <th>Courriel</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher): ?>
                <tr>
                    <td><?= $teacher->getFirstname() ?></td>
                    <td><?= $teacher->getLastname() ?></td>
                    <td><?= $teacher->getUsername() ?></td>
                    <td><?= $teacher->getCourriel() ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Nom d'utilisateur</th>
                <th>Courriel</th>
            </tr>
        </tfoot>
    </table>
</div>