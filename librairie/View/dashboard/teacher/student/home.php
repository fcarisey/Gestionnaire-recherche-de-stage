<?php

if (isset($_POST['ajax']) && (isset($_POST['value']) || isset($_POST['id']))){
    if (isset($_POST['value'])){
        if (!empty(trim($_POST['value']))){
            $s = explode(' ', ltrim(rtrim($_POST['value'])));
            $execute = [];
            $SQL = "SELECT idstudent, username, firstname, lastname, profilpicture FROM student WHERE";
        
            for ($i = 0; $i < count($s); $i++){
                if ($i > 0 && $i < count($s))
                    $SQL .= " OR";
        
                $SQL .= " firstname LIKE :firstname$i OR lastname LIKE :lastname$i OR username LIKE :username$i";
        
                $execute[":firstname$i"] = "%$s[$i]%";
                $execute[":lastname$i"] = "%$s[$i]%";
                $execute[":username$i"] = "%$s[$i]%";
            }
        
            $data = \Database::$db_array['grds']->specialRequest($SQL, $execute, \Model\Student::class);
        
            $students = [];
            if ($data){
                foreach ($data as $d){
                    $x = count($students);
                    $students = array_merge($students, [
                        "idstudent".$x => $d->getIdstudent(),
                        "firstname".$x => $d->getFirstname(),
                        "lastname".$x => $d->getLastname(),
                        "username".$x => $d->getUsername(),
                        "profilpicture".$x => $d->getProfilpicture()
                    ]);
                }
            }
    
            echo json_encode($students, JSON_INVALID_UTF8_IGNORE);
        }
    }else if (isset($_POST['id'])){
        $id = $_POST['id'];
        $user = \Controller\StudentController::SELECT(['lastname', 'firstname', 'profilpicture', 'cv', 'lm', 'idclasse'], ['idstudent' => $id])[0];

        $data = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'profilpicture' => $user->getProfilpicture(),
            'cv' => $user->getCv(),
            'lm' => $user->getLm(),
            'classe' => \Controller\ClasseController::SELECT(['designation'], ['idclasse' => $user->getIdclasse()])[0]->getDesignation(),
            'stat' => "En cours"
        ];

        echo json_encode($data, JSON_INVALID_UTF8_IGNORE);
    }

    die;
}

?>

<style>
    
</style>

<div id="dt_student">
    <div>
        <div>
            <div id="searchbar">
                <div>
                    <input type="text" placeholder="Rechercher un élève ..." onkeyup="dt_studentsearch()">
                    <a><img src="/picture/search ico.png" alt="search"></a>
                </div>
                <div id="presumedresult"></div>
            </div>
        </div>
    </div>
    <div id="infos"></div>
</div>
