<?php



?>

<style>
    
    #da_class_create td{
        width: 50%;
    }

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
    <form id="class_create" onclick="createClass(event, this)" name="class_create">
        <table>
            <tbody>
                <tr>
                    <td>
                        <label>
                            Designation :
                            <input required type="text" name="designation" placeholder="Nom de la classe">
                        </label>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label>
                            Date de début du stage :
                            <input type="date" name="start_date">
                        </label>
                    </td>
                    <td>
                        <label>
                            Date de fin du stage :
                            <input type="date" name="end_date">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td><button class="btn">Créer</button></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </form>
    <form id="class_create_file" name="class_create_file">
        <div>
            <input type="file" name="file">
            <img src="//via.placeholder.com/100x150" alt="">
            <button class="btn">Créer</button>
        </div>
    </form>
</div>