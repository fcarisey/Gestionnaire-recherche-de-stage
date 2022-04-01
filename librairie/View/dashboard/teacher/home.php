<?php

$idclasse = \Controller\AffiliateController::SELECT(['idclasse'], ['idteacher' => $_SESSION['id']])[0]->getIdclasse();
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

<div id='dt_home'>
    <div>
        <div>
            <h3>Elèves ayant trouvé un stage</h3>
            <div>
                <p><?= $find ?>%</p>
                <img src="https://chart.apis.google.com/chart?chs=200x200&chdlp=b&chd=t:<?= $inProgress + $notStart ?>,<?= $find ?>&cht=p&chdl=<?= $inProgress + $notStart ?>%Non%20trouv%C3%A9|<?= $find ?>%Trouv%C3%A9&chdlp=&chdls=000000,12" alt="chart p">
            </div>
        </div>
    </div>
    <div>
        <h3>Proposition de stage ayant le plus d'élève interessé</h3>
        <img src="https://chart.apis.google.com/chart?chs=300x100&chd=t:<?= $values ?>&cht=p&chco=ff9900|d6b79a&chdl=<?= $names ?>" alt="chart b">
    </div>
</div>