<?php

if (isset($_POST['ajax'], $_POST['value'])){
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

    die;
}

?>

<div id="dt_student">
    <div>
        <div>
            <div id="searchbar">
                <input type="text" placeholder="Rechercher un élève ..." onkeyup="dt_studentsearch()">
                <a><img src="/picture/search ico.png" alt="search"></a>
            </div>
            <div id="presumedresult">
           <!-- <div>
                    <img src="" alt="PP">
                    <div>
                        <p></p>
                        <p></p>
                    </div>
                    <input type="hidden" name="id" value="">
                </div> -->
            </div>
        </div>
    </div>
    <div id="infos">
        <h3 id="name">NOM DE FAMILLE Prénom, Classe</h3>
        <div>
            <div>
                <img id="profilpicture" src="//via.placeholder.com/200" alt="PP">
                <p id="stat">En cours</p>
            </div>
            <div>
                <a id="cv" href="" target="_blank"><img src="//via.placeholder.com/150" alt="CV"></a>
                <a id="lm" href="" target="_blank"><img src="//via.placeholder.com/150" alt="LM"></a>
            </div>
        </div>
        <div>

        </div>
    </div>
    
</div>
