<?php

$idclasse = \Controller\AffiliateController::SELECT(['idclasse'], ['idteacher' => $_SESSION['id']]);
if ($idclasse)
    $idclasse = $idclasse[0]->getIdclasse();
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

$inProgress = floor($inProgress * 100 / $totalStudent);
$find = floor($find * 100 / $totalStudent);
$notStart = floor($notStart * 100 / $totalStudent);

$interests = \Database::$db_array['grds']->specialRequest("SELECT COUNT(I.idstudent) AS nb, IT.designation FROM interest I INNER JOIN internship IT ON I.idinternship = IT.idinternship GROUP BY IT.designation ORDER BY COUNT(idstudent) DESC LIMIT 5", []);

$values = "";
$names = "";
for ($i = 0; $i < count($interests); $i++){
    $values .= $interests[$i]['nb'];
    $names .= $interests[$i]['designation'];

    if ($i < count($interests) - 1){
        $values .= ',';
        $names .= '|';
    }
}


?>

<style>
    #dt_home{
        width: 70%;
        margin: auto;
    }

    #dt_home > table{
        width: 100%;
        border-collapse: separate;
        border-spacing: 10px;
    }

    #dt_home > table td{
        box-shadow: 2px 2px 3px 2px #0000004d;
        padding: 15px;
        position: relative;
        width: 50%;
    }

    #dt_home > table td h3{
        position: absolute;
        top: 15px;
        
    }

    #dt_home > table td:first-child h3{
        left: calc(50% - 152px);
    }

    #dt_home > table td img{
        margin-left: 100px;
    }
</style>

<div id='dt_home'>
    <table>
        <tbody>
            <tr>
                <td>
                    <h3>Elèves ayant trouvé un stage</h3>
                    <img src="https://chart.apis.google.com/chart?chs=200x200&chdlp=b&chd=t:<?= $inProgress + $notStart ?>,<?= $find ?>&cht=p&chdl=<?= $inProgress + $notStart ?>%Non%20trouv%C3%A9|<?= $find ?>%Trouv%C3%A9&chdlp=&chdls=000000,12" alt="chart p">
                </td>
                <td>
                    <h3>Proposition de stage ayant le plus d'élève interessé</h3>
                    <img src="https://chart.apis.google.com/chart?chs=300x100&chd=t:<?= $values ?>&cht=p&chco=ff9900|d6b79a&chdl=<?= $names ?>" alt="chart b">
                </td>
            </tr>
        </tbody>
    </table>
</div>