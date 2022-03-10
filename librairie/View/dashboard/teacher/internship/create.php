<?php

$classes = [];
$affiliates = \Controller\AffiliateController::SELECT(['idclasse'], ['idteacher' => $_SESSION['id']]);
if ($affiliates){
    foreach ($affiliates as $affiliate){
        $classes = array_merge($classes, \Controller\ClasseController::SELECT(['designation'], ['idclasse' => $affiliate->getIdclasse()]));
    }
}

?>

<style>
    #dt_internship_create{
        display: flex;
        margin-top: 25px;
    }

    #dt_internship_create > div{
        display: flex;
        flex-direction: column;
        width: 100%;
        padding: 0 50px;
        justify-content: space-between;
    }

    #dt_internship_create > div > label{
        display: flex;
        flex-direction: column;
    }

    #dt_internship_create > div > label > input, #dt_internship_create > div textarea, #dt_internship_create > div select{
        border-radius: 5px;
        box-shadow: 0 0 9px -7px black inset;
        background-color: #dfdfdf;
        border: none;
        padding: 10px;
    }

    #dt_internship_create > div:first-child{
        margin-left: 100px;
        min-height: 800px;
    }

    #dt_internship_create > div:last-child{
        height: 400px;
    }

    #dt_internship_create > div:first-child > label > textarea{
        resize: vertical;
    }

    #dt_internship_create > div:first-child > button{
        padding: 10px 15px;
        border: 1px solid #396ADA;
        border-radius: 5px;
        color: #396ADA;
        width: fit-content;
        transition: 200ms;
    }

    #dt_internship_create > div:first-child > button:hover{
        background-color: #396ada85;
        color: white;
        cursor: pointer;
    }
    
</style>

<div id="dt_internship_create">
    <div>
        <label class="mandatory">
            Designation:
            <input placeholder="Designation" id="designation" type="text">
        </label>
        <label class="mandatory">
            Courte description:
            <textarea placeholder="Courte description" id="shortdescription" cols="30" rows="10"></textarea>
        </label>
        <label class="mandatory">
            Description:
            <textarea placeholder="Description" id="description" cols="50" rows="25"></textarea>
        </label>
        <button id="submit">Créer</button>
    </div>
    <div>
        <label class="mandatory">
            Classe:
            <select id="class">
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
            <input type="text" placeholder="Entreprise" id="enterprise">
        </label>
        <label>
            Site web:
            <input type="url" placeholder="https://exemple.com" id="website">
        </label>
        <label>
            Téléphone
            <input type="tel" placeholder="00.00.00.00.00" id="phone">
        </label>
        <label>
            Courriel
            <input type="email" placeholder="john.doe@exemple.com" id="email">
        </label>
    </div>
</div>