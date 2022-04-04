<?php

if (isset($_POST['ajax']) && isset($_POST['internship-1'])){
    $designation = htmlspecialchars($_POST['designation']);
    $sdescription = htmlspecialchars($_POST['sdescription']);
    $description = htmlspecialchars($_POST['description']);
    $class = htmlspecialchars($_POST['class']);
    $enterprise = htmlspecialchars($_POST['enterprise']);
    $website = htmlspecialchars($_POST['website']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);

    $err = [];

    $designationParse = false;
    if (!empty($designation)){
        $designationParse = true;
    }else
        $err['designation'] = "La designation du stage est obligatoire !";

    $sdescriptionParse = false;
    if (!empty($sdescription)){
        $sdescriptionParse = true;
    }else
        $err['sdescription'] = "La courte description est obligatoire !";

    $descriptionParse = false;
    if (!empty($description)){
        $descriptionParse = true;
    }else
        $err['description'] = "La description est obligatoire !";

    $classParse = false;
    if (!empty($class)){
        $affiliations = \Controller\AffiliateController::SELECT(\Database::SELECT_ALL, [
            'idteacher' => $_SESSION['id'],
            'AND' => \Database::WHERE_KEY,
            'idclasse' => (int)$class
        ]);

        if (!empty($affiliations)){
            $classParse = true;
        }else
            $err['class'] = "La classe selectionné ne vous a pas été attribuer !";
    }else
        $err['class'] = "La classe est obligatoire !";

    $enterpriseParse = false;
    if (!empty($enterprise)){
        $enterpriseParse = true;
    }else
        $err['enterprise'] = "Le nom de l'entreprise est obligatoire !";

    $websiteParse = true;
    if (!filter_var($website, FILTER_VALIDATE_URL) && !empty($website)){
        $err['website'] = "L'url n'est pas valide !";
        $websiteParse = false;
    }
        

    $phoneParse = true;
    if (!preg_match('([0-9]{10})', $phone) && !empty($phone)){
        $err['phone'] = "Le numéro de téléphone n'est pas valide !";
        $phoneParse = false;
    }
        

    $emailParse = true;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)){
        $err['email'] = "Le courriel n'est pas valide !";
        $emailParse = false;
    }

    if ($designationParse && $sdescriptionParse && $descriptionParse && $classParse && $enterpriseParse && $websiteParse && $phoneParse && $emailParse){
        $values = [
            'designation' => $designation,
            'description' => $description,
            'shortdescription' => $sdescription,
            'enterprise' => $enterprise,
            'isdone' => 0,
            'idclasse' => (int)$class
        ];

        if ($websiteParse) $values['website'] = $website;
        if ($phoneParse) $values['phone'] = $phone;
        if ($emailParse) $values['email'] = $email;

        try {
            \Controller\InternshipController::INSERT($values);
            $err['valide'] = true;
        } catch (Exception $e) {
            $err['err'] = $e->getMessage();
        }
    }

    echo json_encode($err);
    die;
}

$classes = [];
$affiliates = \Controller\AffiliateController::SELECT(['idclasse'], ['idteacher' => $_SESSION['id']]);
if ($affiliates){
    foreach ($affiliates as $affiliate){
        $classes = array_merge($classes, \Controller\ClasseController::SELECT(['designation', 'idclasse'], ['idclasse' => $affiliate->getIdclasse()]));
    }
}

?>

<style>
    #dt_internship_create{
        margin-top: 25px;
    }

    #dt_internship_create > form{
        display: flex;
    }

    #dt_internship_create > form > div{
        display: flex;
        flex-direction: column;
        width: 100%;
        padding: 0 50px;
        justify-content: space-between;
    }

    #dt_internship_create > form > div > label{
        display: flex;
        flex-direction: column;
    }

    #dt_internship_create > form > div:first-child{
        margin-left: 100px;
        min-height: 800px;
    }

    #dt_internship_create > form > div:last-child{
        height: 400px;
    }

    #dt_internship_create > form > div:first-child > label > textarea{
        resize: none;
    }

    #dt_internship_create > form > div:first-child > button{
        border-radius: 5px; 
        width: fit-content;
    }

    #dt_internship_create > form > div:first-child > button:hover{
        background-color: #396ada85;
        color: white;
        cursor: pointer;
    }
    
</style>

<div id="dt_internship_create">
    <form name="createinternship" onsubmit="createInternship(event)">
        <div>
            <label class="mandatory">
                Designation:
                <small id="designationError"></small>
                <input required placeholder="Designation" name="designation" id="designation" type="text">
            </label>
            <label class="mandatory">
                Courte description:
                <small id="sdescriptionError"></small>
                <textarea required placeholder="Courte description" name="shortdescription" id="shortdescription" cols="30" style="height: 160px;"></textarea>
            </label>
            <label class="mandatory">
                Description:
                <small id="descriptionError"></small>
                <textarea required placeholder="Description" name="description" id="description" cols="50" style="height: 400px;"></textarea>
            </label>
            <small id="errError"></small>
            <button class="btn" id="submit">Créer</button>
        </div>
        <div>
            <label class="mandatory">
                Classe:
                <small id="classError"></small>
                <select required id="class" name="class">
                    <option selected value="">Selectioner une classe:</option>
                    <optgroup>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class->getIdclasse() ?>"><?= $class->getDesignation() ?></option>
                        <?php endforeach ?>
                    </optgroup>
                </select>
            </label>
            <label class="mandatory">
                Entreprise:
                <small id="enterpriseError"></small>
                <input required type="text" name="enterprise" placeholder="Entreprise" id="enterprise">
            </label>
            <label>
                Site web:
                <small id="sitewebError"></small>
                <input type="url" name="website" placeholder="https://exemple.com" id="website" pattern="^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+$">
            </label>
            <label>
                Téléphone
                <small id="phoneError"></small>
                <input type="tel" name="phone" placeholder="0000000000" id="phone">
            </label>
            <label>
                Courriel
                <small id="emailError"></small>
                <input type="email" name="email" placeholder="john.doe@exemple.com" id="email" pattern="(([a-zA-Z0-9.-]+)@([a-zA-Z0-9-_]+).([a-zA-Z0-9-_]+))">
            </label>
        </div>
    </form>
</div>