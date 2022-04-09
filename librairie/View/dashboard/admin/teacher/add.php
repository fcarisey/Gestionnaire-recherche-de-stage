<?php

if (isset($_POST['ajax']) && (isset($_POST['addTeacher']) || isset($_POST['addTeacherFile']))){

    $err = [];

    if (isset($_POST['addTeacher'])){
        $firstname = htmlspecialchars(\Controller\ControllerController::keyExist('firstname', $_POST));
        $lastname = htmlspecialchars(\Controller\ControllerController::keyExist('lastname', $_POST));
        $username = strtolower(substr($firstname, 0, 1) . $lastname);
        $email = $username . "@groupmontroland.fr";
        $password = substr(password_hash("$email$username", PASSWORD_DEFAULT), 10, 12);

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

        if ($firstnameParse && $lastnameParse){
            $teacher = \Controller\TeacherController::SELECT(\Database::SELECT_ALL, [
                'username' => $username
            ]);

            if (!$teacher){
                try{
                    \Controller\TeacherController::INSERT([
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'username' => $username,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'courriel' => $email,
                        'profilpicture' => "default.png",
                    ]);

                    \Controller\MailController::sendMailTo('fcarisey6@gmail.com', "Identidiant GRDS", "Votre nom d'utilisateur : $username <br> Voici votre mot de passe : $password", "Votre nom d'utilisateur : $username \n Voici votre mot de passe : $password");

                    $err['valide'] = "Le professeur $username à bien été créé !";
                }catch (\Throwable $e){
                    $err['error'] = "Une erreur est survenue veuilliez réessayer !";
                }
                
            }else
                $err['error'] = "Le professeur existe déjà !";
        }

    }else if (isset($_POST['addTeacherFile'])){
        $file = $_FILES['file'];

        $handle = fopen($file['tmp_name'], 'r');
        $values = "";
        while ($data = fgetcsv($handle, 0, ';')){
            $firstname = htmlspecialchars($data[0]);
            $lastname = htmlspecialchars($data[1]);
            $username = strtolower(substr($firstname, 0, 1) . $lastname);
            $email = $username . "@groupmontroland.fr";
            $password = substr(password_hash("$email$username", PASSWORD_DEFAULT), 10, 12);

            $firstnameParse = false;
            if (!empty($firstname)){
                $firstnameParse = true;
            }else
                $err['firstname'] = "Le prénom est obligatoire !";

            $lastnameParse = false;
            if (!empty($lastname)){
                $lastnameParse = true;
            }else
                $err['lastname'] = "Le nom est obligatoire !";

            if ($firstnameParse && $lastnameParse){
                $teacher = \Controller\TeacherController::SELECT(\Database::SELECT_ALL, [
                    'username' => $username
                ]);

                if (!$teacher){
                    \Controller\MailController::sendMailTo('fcarisey6@gmail.com', "Identidiant GRDS", "Votre nom d'utilisateur : $username <br> Voici votre mot de passe : $password", "Votre nom d'utilisateur : $username\nVoici votre mot de passe : $password");

                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $values .= "('$firstname', '$lastname', '$username', '$password', 'default.png', '$email'),";
                }
            }
        }

        $values = substr($values, 0, -1);

        try {
            \Database::$db_array['grds']->specialRequest("INSERT INTO teacher (firstname, lastname, username, password, profilpicture, courriel) VALUES $values", []);

            $err['valide'] = "Les professeurs ont bien été créé !";
        } catch (\Throwable $e) {
            $err['error'] = "Une erreur est survenue veuilliez réessayer !";
        }
    }

    echo json_encode($err);
    die;
}

?>

<style>

    #da_teacher_create table{
        border-collapse: separate;
        border-spacing: 120px 60px;
    }

    #da_teacher_create td label{
        display: flex;
        flex-direction: column;
    }

    #da_teacher_create .btn{
        margin: auto;
    }

    #da_teacher_create input{
        width: 250px;
    }

    #da_teacher_create{
        display: flex;
    }

    #da_teacher_create form:first-child{
        width: 65%;
    }

    #da_teacher_create form:first-child{
        border-right: 3px solid gray;
    }

    #teacher_create_file .btn{
        position: absolute;
        top: 175px;
        left: 10px;
    }

    #teacher_create_file div input:hover{
        cursor: pointer;
    }

    #teacher_create_file{
        width: 35%;
    }

    #teacher_create_file div{
        position: relative;
        margin: auto;
        width: 100px;
        margin-top: 100px;
    }

    #teacher_create_file div input{
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

</style>

<div id="da_teacher_create">
    <form id="teacher_create" onsubmit="createTeacher(event, this)" name="teacher_create">
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
                    <td><button class="btn">Créer</button></td>
                    <td class="formValidation"></td>
                </tr>
            </tbody>
        </table>
    </form>
    <form id="teacher_create_file" name="class_create_file" onsubmit="createTeacherFile(event, this)">
        <div>
            <input required type="file" name="file" accept=".csv">
            <img src="//via.placeholder.com/100x150" alt="">
            <button class="btn">Créer</button>
        </div>
    </form>
</div>