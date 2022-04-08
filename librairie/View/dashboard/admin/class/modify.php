<?php

if (isset($_POST['ajax']) && (isset($_POST['selectClass']) || isset($_POST['modifyClass']))){
    $err = [];

    if (isset($_POST['selectClass'])){
        $class = \Controller\ClasseController::SELECT(\Database::SELECT_ALL, [
            'idclasse' => $_POST['id']
        ])[0];

        $teacher = \Controller\AffiliateController::SELECT(['idteacher'], [
            'idclasse' => $class->getIdclasse()
        ]);
        
        if ($teacher)
            $teacherId = $teacher[0]->getIdteacher();
        else
            $teacherId = -1;
    
        $err['designation'] = $class->getDesignation();
        $err['stageStart'] = $class->getInternshipdatestart();
        $err['stageEnd'] = $class->getInternshipdateend();
        $err['idTeacher'] = $teacherId;
        
    }else if (isset($_POST['modifyClass'])){
        $designation = htmlspecialchars($_POST['designation']);
        $startDate =  date("Y-m-d", strtotime(str_replace('/', '-', $_POST['start_date'])));
        $endDate = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['end_date'])));
        $teacher = $_POST['teacher'];
        $id = $_POST['id'];

        $designationParse = false;
        if (!empty($designation)){
            $class = \Database::$db_array['grds']->specialRequest("SELECT * FROM classe WHERE designation = :designation AND idclasse != :idclasse", [
                ':designation' => $designation,
                ':idclasse' => $id
            ], \Model\Classe::class);
    
            if (!$class){
                $designationParse = true;
            }else
                $err['error'] = "Cette classe existe déjà !";
        }else
            $err['designation'] = "La designation de la classe est obligatoire !";
    
        $dateParse = false;
        if (!(($startDate || $endDate) && !($startDate && $endDate))){
            $dateParse = true;
        }else
            $err['date'] = "Les deux dates doivent être remplient !";

        if ($designationParse && $dateParse){
            try{
                \Controller\ClasseController::UPDATE([
                    'designation' => $designation,
                    'internshipdatestart' => $startDate,
                    'internshipdateend' => $endDate
                ],[
                    'idclasse' => $id
                ]);

                \Controller\AffiliateController::DELETE([
                    'idclasse' => (int)$id
                ]);

                if ((int)$teacher != -1){
                    \Controller\AffiliateController::INSERT([
                        'idteacher' => (int)$teacher,
                        'idclasse' => (int)$id
                    ]);
                }

                $err['valide'] = "La classe $designation bien été modifié !";
            }catch (Throwable $e){
                $err['error'] = "Une erreur s'est produite veuilliez réessayez !";
            }
        }        
    }

    echo json_encode($err);
    die;
}

$classes = \Controller\ClasseController::SELECT();
$teachers = \Database::$db_array['grds']->specialRequest("SELECT T.idteacher, T.firstname, T.lastname, A.idteacher as affiliateidteacher, COUNT(A.idteacher) as nbclasse FROM teacher T LEFT JOIN affiliate A ON T.idteacher = A.idteacher GROUP BY T.idteacher, T.firstname, T.lastname, A.idteacher", []);

?>

<style>

    #da_class_modify table{
        border-collapse: separate;
        border-spacing: 120px 60px;
    }

    #da_class_modify td label{
        display: flex;
        flex-direction: column;
    }

    #da_class_modify .btn{
        margin: auto;
    }

    #da_class_modify input{
        width: 250px;
    }

    #da_class_modify{
        display: flex;
    }

    #da_class_modify form:first-child{
        width: 65%;
        width: fit-content;
        margin: auto;
    }

    #classes{
        height: fit-content;
        margin-left: 50px;
        margin-top: 30px;
    }

</style>

<div id="da_class_modify">
    <select id="classes" onchange="selectClassModify(this)">
        <option selected>Veuillez selectionnez une classe</option>
        <optgroup>
            <?php foreach ($classes as $classe): ?>
                <option value="<?= $classe->getIdclasse() ?>"><?= $classe->getDesignation() ?></option>
            <?php endforeach ?>
        </optgroup>
    </select>
    <form id="class_modify" onsubmit="modifyClass(event, this)" name="class_modify">
        <table>
            <tbody>
                <tr>
                    <td>
                        <label class="mandatory">
                            Designation :
                            <input class="mandatory" autocomplete="off" required type="text" name="designation" placeholder="Nom de la classe">
                            <small class="inputError" id="designationError"></small>
                        </label>
                    </td>
                    <td>
                        <label class="mandatory">
                            Professeur principal :
                            <select name="teacher">
                                <option value="-1">Veuillez selectionner un professeur</option>
                                <optgroup>
                                    <?php foreach ($teachers as $teacher): ?>
                                        <option value="<?= $teacher['idteacher'] ?>"><?= $teacher['lastname'] ?> <?= $teacher['firstname'] ?> <?= $teacher['nbclasse'] ?></option>
                                    <?php endforeach ?>
                                </optgroup>
                            </select>
                            <small class="inputError" id="teacherError"></small>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            Date de début du stage :
                            <input type="date" name="start_date">
                            <small class="inputError dateError"></small>
                        </label>
                    </td>
                    <td>
                        <label>
                            Date de fin du stage :
                            <input type="date" name="end_date">
                            <small class="inputError dateError"></small>
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