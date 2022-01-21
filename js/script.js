window.onload = () => {
    contact();
}

function contact(){
    document.querySelector("#contact button[type='button']")?.addEventListener("click", () => {        
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "./contact", true);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);

                let objectError = document.querySelector("#contact form label #objectError");
                let courrielError = document.querySelector("#contact form label #courrielError");
                let messageError = document.querySelector("#contact form label #messageError");

                objectError.innerHTML = "";
                courrielError.innerHTML = "";
                messageError.innerHTML = "";

                if (response.object){
                    objectError.innerHTML = response.object;
                }

                if (response.courriel){
                    courrielError.innerHTML = response.courriel;
                }

                if (response.message){
                    messageError.innerHTML = response.message;
                }

                if (response.valide){
                    console.log(response.valide);
                }
            }
        }

        let object = document.querySelector("#contact input[name='object']").value;
        let courriel = document.querySelector("#contact input[name='courriel']")?.value;
        let message = document.querySelector("#contact textarea[name='message']").value;

        let form = new FormData();
        form.append("ajax", true);
        form.append("object", object);
        if (courriel !== null)
            form.append("courriel", courriel);
        form.append("message", message);

        xhr.send(form);
    });
}
