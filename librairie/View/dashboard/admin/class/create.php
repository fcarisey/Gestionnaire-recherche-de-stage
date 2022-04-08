<?php

if (isset($_POST['ajax']) && (isset($_POST['class/create']) || isset($_POST['class/createFile']))){
    $err = [];

    if (isset($_POST['class/create'])){
        $designation = $_POST['designation'];
        $startDate = \Controller\ControllerController::keyExist('start_date', $_POST);
        $endDate = \Controller\ControllerController::keyExist('end_date', $_POST);
        $teacher = \Controller\ControllerController::keyExist('teacher', $_POST);

        $designationParse = false;
        if (!empty($designation)){
            $class = \Controller\ClasseController::SELECT(['idclasse'], [
                'designation' => $designation
            ], 1);
    
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
            try {
                $values = [
                    'designation' => $designation
                ];
                if ($startDate && $endDate){
                    $values['internshipdatestart'] = $startDate;
                    $values['internshipdateend'] = $endDate;
                }

                \Controller\ClasseController::INSERT($values);

                $id = \Controller\ClasseController::SELECT(['idclasse'], ['designation' => $designation])[0]->getIdclasse();
    

                if ((int)$teacher != -1){
                    \Controller\AffiliateController::INSERT([
                        'idteacher' => (int)$teacher,
                        'idclasse' => $id
                    ]);
                }
                
                $err['valide'] = "La classe $designation à bien été créée !";
            } catch (\Throwable $th) {
                $err['error'] = "Une erreur s'est produite, veuillez réessayer !";
            }
        }
    }else if(isset($_POST['class/createFile'])){
        $file = $_FILES['file'];

        $handle = fopen($file['tmp_name'], 'r');
        $values = "";
        while ($data = fgetcsv($handle, 0, ';')){
            $designation = $data[0];
            $startDate =  date("Y-m-d", strtotime(str_replace('/', '-', $data[1])));
            $endDate = date("Y-m-d", strtotime(str_replace('/', '-', $data[2])));

            $class = \Controller\ClasseController::SELECT(\Database::SELECT_ALL, [
                'designation' => $designation
            ]);

            if (!$class)
                $values .= "('$designation', '$startDate', '$endDate'),";
        }

        $values = substr($values, 0, -1);

        \Database::$db_array['grds']->specialRequest("INSERT INTO classe (designation, internshipdatestart, internshipdateend) VALUES $values", []);
    }

    echo json_encode($err);
    die;
}

$teachers = \Database::$db_array['grds']->specialRequest("SELECT T.idteacher, T.firstname, T.lastname, COUNT(A.idteacher) as nbclasse FROM teacher T LEFT JOIN affiliate A ON T.idteacher = A.idteacher GROUP BY T.idteacher, T.firstname, T.lastname", []);

?>

<style>

    #da_class_create table{
        border-collapse: separate;
        border-spacing: 120px 60px;
    }

    #da_class_create td label{
        display: flex;
        flex-direction: column;
    }

    #da_class_create .btn{
        margin: auto;
    }

    #da_class_create input{
        width: 250px;
    }

    #da_class_create{
        display: flex;
    }

    #da_class_create form:first-child{
        width: 65%;
    }

    #da_class_create form:first-child{
        border-right: 3px solid gray;
    }

    #class_create_file .btn{
        position: absolute;
        top: 175px;
        left: 10px;
    }

    #class_create_file div input:hover{
        cursor: pointer;
    }

    #class_create_file{
        width: 35%;
    }

    #class_create_file div{
        position: relative;
        margin: auto;
        width: 100px;
        margin-top: 100px;
    }

    #class_create_file div input{
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

</style>

<div id="da_class_create">
    <form id="class_create" onsubmit="createClass(event, this)" name="class_create">
        <table>
            <tbody>
                <tr>
                    <td>
                        <label class="mandatory">
                            Designation :
                            <input autocomplete="off" required type="text" name="designation" placeholder="Nom de la classe">
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
                    <td><button class="btn">Créer</button></td>
                    <td class="formValidation"></td>
                </tr>
            </tbody>
        </table>
    </form>
    <form id="class_create_file" name="class_create_file" onsubmit="createClassFile(event, this)">
        <div>
            <input required type="file" name="file" accept=".csv">
            <img src="//via.placeholder.com/100x150" alt="">
            <button class="btn">Créer</button>
        </div>
    </form>
</div>