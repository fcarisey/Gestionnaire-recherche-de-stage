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

                let objectInput = document.querySelector("#contact form label input[name='object']");
                let courrielInput = document.querySelector("#contact form label input[name='courriel']");
                let messageTextarea = document.querySelector("#contact form label textarea[name='message']");

                objectInput.classList.remove("OK", "KO");
                courrielInput.classList.remove("OK", "KO");
                messageTextarea.classList.remove("OK", "KO");

                let objectError = document.querySelector("#contact form label #objectError");
                let courrielError = document.querySelector("#contact form label #courrielError");
                let messageError = document.querySelector("#contact form label #messageError");
                let OK = document.querySelector("#contact form div #valide");

                objectError.innerHTML = "";
                if (courrielError !== null)
                    courrielError.innerHTML = "";
                messageError.innerHTML = "";
                OK.innerHTML = "";

                if (response.object){
                    objectError.innerHTML = response.object;
                    objectInput.classList.add("KO");
                }else
                    objectInput.classList.add("OK");

                if (response.courriel){
                    courrielError.innerHTML = response.courriel;
                    courrielInput.classList.add("KO");
                }else
                    courrielInput.classList.add("OK");

                if (response.message){
                    messageError.innerHTML = response.message;
                    messageTextarea.classList.add("KO");
                }else
                    messageTextarea.classList.add("OK");

                if (response.valide){
                    OK.innerHTML = response.valide;

                    OK.classList.add("OK");

                    setTimeout(() => {
                        OK.innerHTML = "";

                        OK.classList.remove("OK");
                        objectInput.classList.remove("OK");
                        courrielInput.classList.remove("OK");
                        messageTextarea.classList.remove("OK");
                    }, 5000);
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
