<style>
    #as_files #CV{
        position: relative;
    }

    #as_files #CV input{
        position: absolute;
        width: 150px;
        height: 150px;
        left: 0;
        top: 0;
        z-index: 9999;
        opacity: 0;
    }

    #as_files #CV input:hover{
        cursor: pointer;
    }
</style>

<div id="as_files">
    <div id="student_files">
        <h2>Voici vos fichiers</h2>
        <table>
            <tbody>
                <tr>
                    <td id="CV">
                        <input type="file" name="cv" accept=".pdf">
                        <img src="/picture/cv.png" alt="CV">
                        <button class="btn">Télécharger votre CV</button>
                    </td>
                    <td id="internship_agreement">

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="class_files">

    </div>
</div>