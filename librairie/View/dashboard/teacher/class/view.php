<?php 

$idclasse = \Controller\ClasseController::SELECT(['idclasse'], ['designation' => $_GET['class']])[0]->getIdclasse();
$students = \Controller\StudentController::SELECT(\Database::SELECT_ALL, ['idclasse' => (int)$idclasse]);

?>

<style>
    #dt_class_view{
        display: flex;
    }

    #dt_class_view > *{
        width: 100%;
    }

    #dt_class_view > div > div{
        margin: auto;
        box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
        padding: 10px 30px;
        text-align: center;
        width: 400px;
    }

    #dt_class_view > div > table{
        width: 500px;
        text-align: left;
    }

    #dt_class_view > div > table thead tr th{
        border-bottom: 4px solid rgb(0 0 0 / 25%);
    }
</style>

<div id="dt_class_view">
    <div>
        <div>
            <h3>Etat de la recherche de stage des élèves</h3>
            <img src="https://chart.apis.google.com/chart?chs=300x200&chdlp=b&chd=t:67,12,11&cht=p&chdl=67%%20En%20cours|12%%20Non%20commenc%C3%A9|11%%20Trouv%C3%A9&chdlp=&chdls=000000,12&chco=cc8d52,993d3d,408040" alt="chart p">
        </div>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Etat</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $student->getFirstname() ?></td>
                    <td><?= $student->getLastname() ?></td>

                    <?php
                        $interests = \Controller\InterestController::SELECT(\Database::SELECT_ALL, ['idstudent' => (int)$student->getIdstudent()]);
                        $currentinternship = \Controller\CurrentinternshipController::SELECT(\Database::SELECT_ALL, ['idstudent' => (int)$student->getIdstudent()]);
                    ?>

                    <?php if ($interests): ?>
                        <td>En cours</td>
                    <?php elseif ($currentinternship): ?>
                        <td>Trouvé</td>
                    <?php else: ?>
                        <td>Pas commencé</td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>