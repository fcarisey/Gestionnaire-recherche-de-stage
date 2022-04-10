<?php

$classes = \Controller\ClasseController::SELECT(\Database::SELECT_ALL);

?>

<style>
    #da_class_home table{
        width: 70%;
        margin: auto;
    }

    #da_class_home thead th{
        border-bottom: 2px solid gray;
    }

    #da_class_home tbody td{
        text-align: center;
    }

    #da_class_home tfoot th{
        border-top: 2px solid gray;
    }
</style>

<div id="da_class_home">
    <table>
        <thead>
            <tr>
                <th>Designation</th>
                <th>Stage début</th>
                <th>Stage fin</th>
                <th>Professeur</th>
                <th>Nombre élève</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($classes)): ?>
                <tr>
                    <td colspan="5">Aucune classe n'est enregistrée</td>
                </tr>
            <?php else: ?>
                <?php foreach ($classes as $classe): ?>
                    <tr>
                        <td><?= $classe->getDesignation() ?></td>
                        <td><?= (!strchr($classe->getInternshipdatestart(), "1970")) ? date('d-m-Y', strtotime($classe->getInternshipdatestart())) : null ?></td>
                        <td><?= (!strchr($classe->getInternshipdateend(), "1970")) ? date('d-m-Y', strtotime($classe->getInternshipdateend())) : null ?></td>

                        <?php

                            $teacherId = \Controller\AffiliateController::SELECT(['idteacher'], [
                                'idclasse' => $classe->getIdclasse()
                            ]);

                            $teacher = null;
                            if ($teacherId) {
                                $teacherId = $teacherId[0]->getIdteacher();

                                $teacher = \Controller\TeacherController::SELECT(['username'], [
                                    'idteacher' => $teacherId
                                ])[0];
                            }

                        ?>

                        <td><?= ($teacher) ? $teacher->getUsername() : null ?></td>

                        <?php

                            $nbEleve = \Database::$db_array['grds']->specialRequest("SELECT COUNT(*) as i FROM student WHERE idclasse = :idclasse", [
                                ':idclasse' => $classe->getIdclasse()
                            ])[0]['i'];

                        ?>

                        <td><?= $nbEleve ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Designation</th>
                <th>Stage début</th>
                <th>Stage fin</th>
                <th>Professeur</th>
                <th>Nombre élève</th>
            </tr>
        </tfoot>
    </table>
</div>