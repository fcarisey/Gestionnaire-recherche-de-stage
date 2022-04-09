<?php

if (isset($_POST['ajax']) && (isset($_POST['value']) || isset($_POST['id']))){
    if (isset($_POST['value'])){
        if (!empty(trim($_POST['value']))){
            $s = explode(' ', trim($_POST['value']));
            $execute = [];

            $SQL = "SELECT idstudent, username, firstname, lastname, profilpicture FROM student WHERE (";
        
            for ($i = 0; $i < count($s); $i++){
                if ($i > 0 && $i < count($s))
                    $SQL .= " OR";
        
                $SQL .= " firstname LIKE :firstname$i OR lastname LIKE :lastname$i OR username LIKE :username$i";
        
                $execute[":firstname$i"] = "%$s[$i]%";
                $execute[":lastname$i"] = "%$s[$i]%";
                $execute[":username$i"] = "%$s[$i]%";
            }

            $SQL .= ")";

            $classesId = \Controller\AffiliateController::SELECT(['idclasse'], ['idteacher' => (int)$_SESSION['id']]);

            $SQL .= " AND (";
            
            for ($i = 0; $i < count($classesId); $i++){
                if ($i > 0 && $i < count($classesId))
                    $SQL .= " OR";

                $SQL .= " idclasse = :idclasse$i";
                $execute[":idclasse$i"] = $classesId[$i]->getIdclasse();
            }

            $SQL .= ")";
        
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
    
            echo json_encode($students);
        }
    }else if (isset($_POST['id'])){
        $id = $_POST['id'];
        $user = \Controller\StudentController::SELECT(['lastname', 'firstname', 'profilpicture', 'cv', 'lm', 'idclasse'], ['idstudent' => $id])[0];

        $interest = \Controller\InterestController::SELECT(\Database::SELECT_ALL, ['idstudent' => $id]);
        $currentinternship = \Controller\CurrentinternshipController::SELECT(\Database::SELECT_ALL, ['idstudent' => $id]);

        if ($currentinternship)
            $status = "Trouvé";
        else if ($interest)
            $status = "En cours";
        else
            $status = "Pas commencer";

        $data = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'profilpicture' => $user->getProfilpicture(),
            'cv' => $user->getCv(),
            'lm' => $user->getLm(),
            'classe' => \Controller\ClasseController::SELECT(['designation'], ['idclasse' => $user->getIdclasse()])[0]->getDesignation(),
            'stat' => $status
        ];

        echo json_encode($data);
    }

    die;
}

?>

<style>
    #dt_student{
        display: flex;
        flex-direction: column;
    }

    #dt_student #searchbar > div:first-child{
        display: flex;
        justify-content: center;
        margin: auto;
    }

    #dt_student #searchbar > div:first-child input{
        border-radius: 5px 0 0 5px;
        font-size: 17px;
        width: 500px;
    }

    #dt_student #searchbar > div:first-child a{
        background-color: #f3a847;
        width: 50px;
        height: 50px;
        transition: background 200ms;
        border-radius: 0 5px 5px 0;
    }

    #dt_student #searchbar > div:first-child a:hover{
        cursor: pointer;
        background-color: #c38638;
    }

    #dt_student #searchbar > div:first-child a img{
        width: 40px;
        height: 40px;
        margin: 10%;
    }

    #dt_student #presumedresult{
        display: flex;
        flex-direction: column;
        width: 550px;
        margin: auto;
        max-height: 200px;
        overflow-y: scroll;
    }

    #dt_student #presumedresult > *{
        display: flex;
    }

    #dt_student #presumedresult > *:hover{
        cursor: pointer;
    }

    #dt_student #presumedresult > * > div{
        margin-left: 50px;
        display: flex;
        align-items: center;
        font-size: 20px;
    }

    #dt_student #presumedresult > * > div > p:last-child{
        margin-left: 20px;
    }

    #dt_student #infos{
        width: 65%;
        margin: auto;
        margin-top: 100px;
        margin-left: 200px;
    }

    #dt_student #infos > h3{
        margin-bottom: 30px;
    }

    #dt_student #infos > div:nth-child(2){
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
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
