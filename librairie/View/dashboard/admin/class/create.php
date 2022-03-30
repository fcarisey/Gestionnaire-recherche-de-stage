<?php

$classes = \Controller\ClasseController::SELECT(['idclasse', 'designation']);

?>

<style>
    #da_class_create{
        display: flex;
    }

    #da_class_create form{
        margin: auto;
        width: fit-content;
    }

    #da_class_create label{
        display: flex;
        flex-direction: column;
    }

    #da_class_create label > *{
        min-width: 250px;
        width: fit-content;
    }

    #create_input label > select{
        min-width: 270px;
    }

    #create_input form > div{
        display: flex;
        justify-content: space-between;
        width: 600px;
    }

    #create_input{
        width: 70%;
    }

    #create_input form > div{
        margin: 50px 0;
    }

    #create_file{
        width: 25%;
    }

    #create_file form{
        display: flex;
        flex-direction: column;
    }

    #create_file form button{
        margin-top: 20px;
        width: fit-content;
    }


</style>

<div id="da_class_create">
    <div id="create_input">
        <form name="create_input" onclick="da_class_create_input(events)">
            <div>
                <label>
                    Prénom :
                    <input autocomplete="none" required name="firstname" type="text" placeholder="John">
                </label>
                <label>
                    Nom :
                    <input autocomplete="none" required name="lastname" type="text" placeholder="Doe">
                </label>
            </div>
            <div>
                <label>
                    Courriel :
                    <input required name="firstname" type="email" placeholder="john.doe@exemple.com">
                </label>
                <label>
                    Classe :
                    <select required name="class">
                        <option selected>Selectionner une classe</option>
                        <optgroup>
                            <?php foreach ($classes as $classe): ?>
                                <option value="<?= $classe->getIdclasse() ?>"><?= $classe->getDesignation() ?></option>
                            <?php endforeach ?>
                        </optgroup>
                    </select>
                </label>
            </div>
            <button class='btn'>Créer</button>
        </form>
    </div>
    <div id="create_file">
        <form name="create_file" onclick="da_class_create_file(event)">
            <input type="file" name="file" accept=".csv">
            <button class="btn">Créer</button>
        </form>
    </div>
</div>