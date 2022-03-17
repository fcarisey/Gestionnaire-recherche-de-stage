<?php 

$idclasse = \Controller\ClasseController::SELECT(['idclasse'], ['designation' => $_GET['class']])[0]->getIdclasse();
$students = \Controller\StudentController::SELECT(\Database::SELECT_ALL, ['idclasse' => (int)$idclasse]);

$inProgress = 0;
$find = 0;
$notStart = 0;
$totalStudent = ($students) ? count($students) : 1;

if ($students)
    foreach ($students as $student) {
        $interests = \Controller\InterestController::SELECT(\Database::SELECT_ALL, ['idstudent' => (int)$student->getIdstudent()]);
        $currentinternship = \Controller\CurrentinternshipController::SELECT(\Database::SELECT_ALL, ['idstudent' => (int)$student->getIdstudent()]);
    
        ($interests) ? $inProgress++ : (($currentinternship) ? $find++ : $notStart++);
    }


$inProgress = $inProgress * 100 / $totalStudent;
$find = $find * 100 / $totalStudent;
$notStart = $notStart * 100 / $totalStudent;

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
            <img src="https://chart.apis.google.com/chart?chs=300x200&chdlp=b&chd=t:<?= $inProgress ?>,<?= $notStart ?>,<?= $find ?>&cht=p&chdl=<?= $inProgress ?>%%20En%20cours|<?= $notStart ?>%%20Non%20commenc%C3%A9|<?= $find ?>%%20Trouv%C3%A9&chdlp=&chdls=000000,12&chco=cc8d52,993d3d,408040" alt="chart p">
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
            <?php if ($students): ?>
                <?php foreach ($students as $student): ?>
                    <tr data-id="<?= $student->getIdstudent() ?>">
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
            <?php endif ?>
            </tbody>
        </table>
    </div>
</div>