window.onload = () => {
    contact();
    login();
    dashboard();
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
                courrielInput?.classList.remove("OK", "KO");
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
                    if (courrielError)
                        objectError.innerHTML = response.object;
                    objectInput.classList.add("KO");
                }else
                    objectInput.classList.add("OK");

                if (response.courriel){
                    if (courrielError)
                        courrielError.innerHTML = response.courriel;
                    courrielInput?.classList.add("KO");
                }else
                    courrielInput?.classList.add("OK");

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
                        courrielInput?.classList.remove("OK");
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

function login(){
    document.querySelector("#login form button[type='button']")?.addEventListener('click', () => {
        let username = document.querySelector("#login form div label input[name='username']");
        let password = document.querySelector("#login form div label input[name='password']");

        let form = new FormData();
        form.append('ajax', true);
        form.append('username', username.value);
        form.append('password', password.value);

        let usernameError = document.querySelector("#login form div label #usernameError");
        let passwordError = document.querySelector("#login form div label #passwordError");
        let accountError = document.querySelector("#login form #accountError");

        usernameError.innerHTML = "";
        passwordError.innerHTML = "";
        accountError.innerHTML = "";

        let xhr = new XMLHttpRequest();
        xhr.open('POST', './login');
        xhr.onreadystatechange = () => {
            if (xhr.responseText != null && xhr.status == 200 && xhr.readyState == 4){
                let response = JSON.parse(xhr.responseText);

                username.classList.remove('OK', 'KO');
                password.classList.remove('OK', 'KO');

                console.log(response);

                if (response.username){
                    username.classList.add('KO');
                    usernameError.innerText = response.username;
                }else
                    username.classList.add('OK');

                if (response.password){
                    password.classList.add('KO');
                    passwordError.innerText = response.password;
                }else
                    password.classList.add('OK');

                if (response.valide){
                    window.location.replace("./");
                }else if (response.account){
                    username.classList.add('KO');
                    password.classList.add('KO');
                    accountError.innerHTML = response.account;
                }
            }
        };
        xhr.send(form);
    });
}

function dashboard(){
    document.querySelectorAll("#dashboard nav ul div div a:nth-child(2)")?.forEach((e) => {
        e.addEventListener('click', () => {
            let p = e.parentNode.parentNode;
            document.querySelector("#" + p.id + " .submenu").classList.toggle("OK");
        });
    });

    document.querySelectorAll("#dashboard nav > ul div > a:last-child")?.forEach((e) => {
        e.addEventListener('click', () => {
            e.classList.toggle("active");
        });
    });
}
