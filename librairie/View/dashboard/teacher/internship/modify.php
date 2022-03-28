<?php

if (isset($_POST['ajax']) && isset($_POST['internship-1'])){
    $id = $_POST['id'];
    $designation = $_POST['designation'];
    $sdescription = $_POST['sdescription'];
    $description = $_POST['description'];
    $class = $_POST['class'];
    $enterprise = $_POST['enterprise'];
    $website = $_POST['website'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

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
            $err['class'] = "La classe selectionné ne vous est pas été attribuer !";
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
        $set = [
            'designation' => $designation,
            'description' => $description,
            'shortdescription' => $sdescription,
            'enterprise' => $enterprise,
            'isdone' => 0,
            'idclasse' => (int)$class
        ];

        if ($websiteParse) $set['website'] = $website;
        if ($phoneParse) $set['phone'] = $phone;
        if ($emailParse) $set['email'] = $email;

        try {
            \Controller\InternshipController::UPDATE($set, ['idinternship' => $id]);
            $err['valide'] = true;
        } catch (Exception $e) {
            $err['err'] = $e->getMessage();
        }
    }

    echo json_encode($err);
    die;
}

$internship = \Controller\InternshipController::SELECT(\Database::SELECT_ALL, [
    'idinternship' => $_GET['id']
])[0];

$classes = [];
$affiliates = \Controller\AffiliateController::SELECT(['idclasse'], ['idteacher' => $_SESSION['id']]);
if ($affiliates){
    foreach ($affiliates as $affiliate){
        $classes = array_merge($classes, \Controller\ClasseController::SELECT(['designation', 'idclasse'], ['idclasse' => $affiliate->getIdclasse()]));
    }
}

?>

<style>
    #dt_internship_modify{
        margin-top: 25px;
    }

    #dt_internship_modify > form{
        display: flex;
    }

    #dt_internship_modify > form > div{
        display: flex;
        flex-direction: column;
        width: 100%;
        padding: 0 50px;
        justify-content: space-between;
    }

    #dt_internship_modify > form > div > label{
        display: flex;
        flex-direction: column;
    }

    #dt_internship_modify > form > div > label > input, #dt_internship_modify > form > div textarea, #dt_internship_modify > form > div select{
        border-radius: 5px;
        border: none;
        border-bottom: 1px solid black;
        padding: 10px;
    }

    #dt_internship_modify > form > div:first-child{
        margin-left: 100px;
        min-height: 750px;
    }

    #dt_internship_modify > form > div:last-child{
        height: 400px;
    }

    #dt_internship_modify > form > div:first-child > label > textarea{
        resize: none;
        border: 1px solid black;
    }

    #dt_internship_modify > form > div:first-child > label > textarea:nth-last-of-type(2){
        overflow: hidden;
    }

    #dt_internship_modify > form > div:first-child > button{
        width: fit-content;
    }
    
</style>

<div id="dt_internship_modify">
    <form name="createinternship" onsubmit="modifyInternship(event, <?= $_GET['id'] ?>)">
        <div>
            <label class="mandatory">
                Designation:
                <small id="designationError"></small>
                <input required placeholder="Designation" id="designation" type="text" value="<?= $internship->getDesignation() ?>">
            </label>
            <label class="mandatory">
                Courte description:
                <small id="sdescriptionError"></small>
                <textarea required placeholder="Courte description" id="shortdescription" cols="30" style="height: 100px;" maxlength="250"><?= $internship->getShortdescription() ?></textarea>
            </label>
            <label class="mandatory">
                Description:
                <small id="descriptionError"></small>
                <textarea required placeholder="Description" id="description" cols="50" style="height: 400px;"><?= $internship->getDescription() ?></textarea>
            </label>
            <small id="errError"></small>
            <button id="submit" class="btn">Modifier</button>
        </div>
        <div>
            <label class="mandatory">
                Classe:
                <small id="classError"></small>
                <select required id="class">
                    <option selected value="">Selectioner une classe:</option>
                    <optgroup>
                        <?php foreach ($classes as $class): ?>
                            <option <?= ($internship->getIdclasse() == $class->getIdclasse()) ? "selected" : null ?>  value="<?= $class->getIdclasse() ?>"><?= $class->getDesignation() ?></option>
                        <?php endforeach ?>
                    </optgroup>
                </select>
            </label>
            <label class="mandatory">
                Entreprise:
                <small id="enterpriseError"></small>
                <input required type="text" placeholder="Entreprise" id="enterprise" value="<?= $internship->getEnterprise() ?>">
            </label>
            <label>
                Site web:
                <small id="sitewebError"></small>
                <input type="url" placeholder="https://exemple.com" id="website" pattern="^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+$" value="<?= $internship->getWebsite() ?>">
            </label>
            <label>
                Téléphone
                <small id="phoneError"></small>
                <input type="tel" placeholder="00.00.00.00.00" id="phone" value="<?= $internship->getPhone() ?>">
            </label>
            <label>
                Courriel
                <small id="emailError"></small>
                <input type="email" placeholder="john.doe@exemple.com" id="email" pattern="(([a-zA-Z0-9.-]+)@([a-zA-Z0-9-_]+).([a-zA-Z0-9-_]+))" value="<?= $internship->getEmail() ?>">
            </label>
        </div>
    </form>
</div>