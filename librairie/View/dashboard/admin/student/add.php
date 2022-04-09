<?php

if (isset($_POST['ajax']) && (isset($_POST['studentAdd']) || isset($_POST['studentAddFile']))){
    $err = [];

    if (isset($_POST['studentAdd'])){
        $firstname = htmlspecialchars(\Controller\ControllerController::keyExist('firstname', $_POST));
        $lastname = htmlspecialchars(\Controller\ControllerController::keyExist('lastname', $_POST));
        $class = (int)htmlspecialchars(\Controller\ControllerController::keyExist('class', $_POST));

        $firstnameParse = false;
        if (!empty($firstname)){
            $firstnameParse = true;
        }else
            $err['firstname'] = "Le prénom est obligaoire !";

        $lastnameParse = false;
        if (!empty($lastname)){
            $lastnameParse = true;
        }else
            $err['lastname'] = "Le nom est obligaoire !";

        $classParse = false;
        if (!empty($class)){
            $classe = \Controller\ClasseController::SELECT(['idclasse'], ['idclasse' => $class]);
            if ($classe){
                $classParse = true;
            }else
                $err['class'] = "La classe n'existe pas !";
        }else
            $err['class'] = "La classe est obligatoire !";

        if ($firstnameParse && $lastnameParse && $classParse){

            $username = strtolower(substr($firstname, 0, 1).$lastname);
            $courriel = $username."@groupmontroland.fr";
            $password = substr(password_hash("$courriel$username", PASSWORD_DEFAULT), 10, 12);
            
            \Controller\MailController::sendMailTo("fcarisey6@gmail.com", "Identidiant GRDS", "Votre nom d'utilisateur : $username <br> Voici votre mot de passe : $password", "Votre nom d'utilisateur : $username \n Voici votre mot de passe : $password");

            try{
                \Controller\StudentController::INSERT([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'idclasse' => $class,
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'courriel' => $courriel,
                    'profilpicture' => "default.png"
                ]);

                $err['success'] = "L'élève a bien été ajouté !";
            }catch(\Throwable $e){
                $err['error'] = "Une erreur est survenue lors de l'ajout de l'élève !";
            }
        }
    }else if(isset($_POST['studentAddFile'])){
        $file = $_FILES['file'];

        $handle = fopen($file['tmp_name'], "r");
        while ($data = fgetcsv($handle, 0, ';')){
            $firstname = htmlspecialchars($data[0]);
            $lastname = htmlspecialchars($data[1]);
            $class = htmlspecialchars($data[2]);

            $firstnameParse = false;
            if (!empty($firstname)){
                $firstnameParse = true;
            }else
                $err['firstname'] = "Le prénom est obligaoire !";

            $lastnameParse = false;
            if (!empty($lastname)){
                $lastnameParse = true;
            }else
                $err['lastname'] = "Le nom est obligaoire !";

            $classParse = false;
            if (!empty($class)){
                $classe = \Controller\ClasseController::SELECT(['idclasse'], ['designation' => $class]);
                if ($classe){
                    $class = $classe[0]->getIdclasse();
                    $classParse = true;
                }else
                    $err['class'] = "La classe n'existe pas !";
            }else
                $err['class'] = "La classe est obligatoire !";

            if ($firstnameParse && $lastnameParse && $classParse){
                $username = strtolower(substr($firstname, 0, 1).$lastname);
                $courriel = $username."@groupmontroland.fr";
                $password = substr(password_hash("$courriel$username", PASSWORD_DEFAULT), 10, 12);
                
                \Controller\MailController::sendMailTo("fcarisey6@gmail.com", "Identidiant GRDS", "Votre nom d'utilisateur : $username <br> Voici votre mot de passe : $password", "Votre nom d'utilisateur : $username \n Voici votre mot de passe : $password");
                
                try{
                    \Controller\StudentController::INSERT([
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'idclasse' => $class,
                        'username' => $username,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'courriel' => $courriel,
                        'profilpicture' => "default.png"
                    ]);

                    $err['success'] = "L'élève a bien été ajouté !";
                }catch(\Throwable $e){
                    $err['error'] = "Une erreur est survenue lors de l'ajout de l'élève !";
                }
            }
        }
    }

    echo json_encode($err);
    die;
}

$classes = \Controller\ClasseController::SELECT();

?>
<style>

    #da_student_create table{
        border-collapse: separate;
        border-spacing: 120px 60px;
    }

    #da_student_create td label{
        display: flex;
        flex-direction: column;
    }

    #da_student_create .btn{
        margin: auto;
    }

    #da_student_create input{
        width: 250px;
    }

    #da_student_create{
        display: flex;
    }

    #da_student_create form:first-child{
        width: 65%;
    }

    #da_student_create form:first-child{
        border-right: 3px solid gray;
    }

    #student_create_file .btn{
        position: absolute;
        top: 175px;
        left: 10px;
    }

    #student_create_file div input:hover{
        cursor: pointer;
    }

    #student_create_file{
        width: 35%;
    }

    #student_create_file div{
        position: relative;
        margin: auto;
        width: 100px;
        margin-top: 100px;
    }

    #student_create_file div input{
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

</style>

<div id="da_student_create">
    <form id="student_create" onsubmit="createStudent(event, this)" name="class_create">
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
                    <td><button class="btn">Créer</button></td>
                    <td class="formValidation"></td>
                </tr>
            </tbody>
        </table>
    </form>
    <form id="student_create_file" name="student_create_file" onsubmit="createStudentFile(event, this)">
        <div>
            <input required type="file" name="file" accept=".csv">
            <img src="//via.placeholder.com/100x150" alt="">
            <button class="btn">Créer</button>
        </div>
    </form>
</div>