<?php

if (isset($_POST['ajax']) && (isset($_POST['studentSearch']) || isset($_POST['studentGetData']) || isset($_POST['studentModify']))){
    $err = [];
    if (isset($_POST['studentSearch'])){
        $s = htmlspecialchars(\Controller\ControllerController::keyExist('s', $_POST));

        $st = explode(' ', trim($s));

        $where = "";
        foreach ($st as $sw) {
            $where .= "firstname Like '%$sw%' OR lastname Like '%$sw%' OR username Like '%$sw%' OR ";
        }

        $where = substr($where, 0, -4);

        try{
            $err['students'] = \Database::$db_array['grds']->specialRequest("SELECT idstudent, firstname, lastname FROM student WHERE $where", []);
        }catch (\Throwable $e){
            $err['error'] = "Erreur lors de la recherche";
        }

    }else if (isset($_POST['studentGetData'])){
        $id = htmlspecialchars(\Controller\ControllerController::keyExist('id', $_POST));

        try{
            $err['student'] = \Database::$db_array['grds']->specialRequest("SELECT * FROM student WHERE idstudent = ?", [$id])[0];
        }catch (\Throwable $e){
            $err['error'] = "Erreur lors de la récupération des données";
        }

    }else if (isset($_POST['studentModify'])){
        $firstname = htmlspecialchars(\Controller\ControllerController::keyExist('firstname', $_POST));
        $lastname = htmlspecialchars(\Controller\ControllerController::keyExist('lastname', $_POST));
        $class = (int)\Controller\ControllerController::keyExist('class', $_POST);

        $firstnameParse = false;
        if (!empty($firstname)){
            $firstnameParse = true;
        }else
            $err['firstname'] = "Le prénom est vide !";

        $lastnameParse = false;
        if (!empty($lastname)){
            $lastnameParse = true;
        }else
            $err['lastname'] = "Le nom est vide !";

        

        if ($firstnameParse && $lastnameParse){
            try{
                $student = \Controller\StudentController::SELECT(['idclasse'], ['idstudent' => $_POST['id']])[0];

                if ($student->getIdclasse() != $class){
                    \Controller\InterestController::DELETE(['idstudent' => $_POST['id']]);
                }

                \Database::$db_array['grds']->specialRequest("UPDATE student SET firstname = ?, lastname = ?, idclasse = ? WHERE idstudent = ?", [$firstname, $lastname, $class, $_POST['id']]);
    
                $err['success'] = "Modification effectuée !";
            }catch (\Throwable $e){
                $err['error'] = "Une erreur est survenue !";
            }
        }
    }

    echo json_encode($err);
    die;
}

$classes = \Controller\ClasseController::SELECT();

?>

<style>

    #da_student_modify table{
        border-collapse: separate;
        border-spacing: 120px 60px;
    }

    #da_student_modify td label{
        display: flex;
        flex-direction: column;
    }

    #da_student_modify .btn{
        margin: auto;
    }

    #da_student_modify input{
        width: 250px;
    }

    #da_student_modify{
        display: flex;
    }

    #da_student_modify form:first-child{
        width: 65%;
    }

    #search{
        margin-left: 70px;
        margin-top: 30px;
    }

    #search #items .item{
        padding: 5px 10px;
    }

    #search #items .item:hover{
        cursor: pointer;
        background-color: #d7d7d7;
    }

</style>

<div id="da_student_modify">
    <div id="search">
        <input type="text" placeholder="Rechercher un élève ..." onkeyup="searchStudent(this)">
        <div id="items"></div>
    </div>
    <form id="student_modify" onsubmit="modifyStudent(event, this)" name="student_modify">
        <table>
            <tbody>
                <tr>
                    <td>
                        <label class="mandatory">
                            Prénom :
                            <input autocomplete="off" required type="text" name="firstname" placeholder="John">
                            <small class="inputError" id="firstnameError"></small>
                        </label>
                    </td>
                    <td>
                        <label class="mandatory">
                            Nom :
                            <input autocomplete="off" required type="text" name="lastname" placeholder="Doe">
                            <small class="inputError" id="lastnameError"></small>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            Classe :
                            <select name="class">
                                <option>Veuillez selectionnez une classe</option>
                                <optgroup>
                                    <?php foreach ($classes as $class): ?>
                                        <option value="<?= $class->getIdclasse() ?>"><?= $class->getDesignation() ?></option>
                                    <?php endforeach ?>
                                </optgroup>
                            </select>
                            <small class="inputError" id="classError"></small>
                        </label>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td><button class="btn">Modifier</button></td>
                    <td class="formValidation"></td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" name="id">
    </form>
</div>