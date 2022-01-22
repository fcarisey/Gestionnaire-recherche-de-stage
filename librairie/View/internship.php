<?php

$internship = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, ['IdInternship' => $_GET['id']])[0];

?>

<div id="internship">
    
</div>
