<?php

if (isset($_POST['ajax']) && (isset($_POST['teacherSearch']) || isset($_POST['teacherGetData']) || isset($_POST['teacherModify']))){
    $err = [];

    if (isset($_POST['teacherSearch'])){
        $s = htmlspecialchars(\Controller\ControllerController::keyExist('s', $_POST));

        $st = explode(' ', trim($s));

        $where = "";
        $execute = [];
        foreach ($st as $sw) {
            $where .= "firstname Like '%$sw%' OR lastname Like '%$sw%' OR username Like '%$sw%' OR ";
        }

        $where = substr($where, 0, -4);

        $err['teachers'] = \Database::$db_array['grds']->specialRequest("SELECT idteacher, firstname, lastname FROM teacher WHERE $where", []);
    }else if (isset($_POST['teacherGetData'])){
        $id = (int)\Controller\ControllerController::keyExist('id', $_POST);

        $err['teacher'] = \Database::$db_array['grds']->specialRequest("SELECT idteacher, firstname, lastname, username, courriel FROM teacher WHERE idteacher = $id", [])[0];
    }else if (isset($_POST['teacherModify'])){
        
    }

    echo json_encode($err);
    die;
}

?>

<style>

    #da_teacher_modify table{
        border-collapse: separate;
        border-spacing: 120px 60px;
    }

    #da_teacher_modify td label{
        display: flex;
        flex-direction: column;
    }

    #da_teacher_modify .btn{
        margin: auto;
    }

    #da_teacher_modify input{
        width: 250px;
    }

    #da_teacher_modify{
        display: flex;
    }

    #da_teacher_modify form:first-child{
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

<div id="da_teacher_modify">
    <div id="search">
        <input type="text" placeholder="Rechercher un professeur ..." onkeyup="searchTeacher(this)">
        <div id="items"></div>
    </div>
    <form id="teacher_modify" onsubmit="modifyTeacher(event, this)" name="teacher_create">
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
                        <label class="mandatory">
                            Nom d'utilisateur :
                            <input autocomplete="off" required type="text" name="username" placeholder="jdoe">
                            <small class="inputError" id="usernameError"></small>
                        </label>
                    </td>
                    <td>
                        <label class="mandatory">
                            Courriel :
                            <input autocomplete="off" required type="email" name="email" placeholder="jdoe@exemple.com">
                            <small class="inputError" id="emailError"></small>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td><button class="btn">Modifer</button></td>
                    <td class="formValidation"></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>