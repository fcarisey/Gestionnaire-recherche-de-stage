window.onload = () => {
    dashboard()
    internshipInterest()

    document.forms['contact']?.addEventListener('submit', (e) => {
        e.preventDefault()
        contact()
    })

    document.forms['login']?.addEventListener('submit', (e) => {
        e.preventDefault()
        login()
    })
}

function contact() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./contact", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);

            let objectInput = document.forms['contact']['object'];
            let courrielInput = document.forms['contact']['courriel'];
            let messageTextarea = document.forms['contact']['message'];

            objectInput.classList.remove("OK", "KO");
            courrielInput?.classList.remove("OK", "KO");
            messageTextarea.classList.remove("OK", "KO");

            let objectError = document.querySelector("#contact form label #objectError");
            let courrielError = document.querySelector("#contact form label #courrielError");
            let messageError = document.querySelector("#contact form label #messageError");
            let OK = document.querySelector("#contact form div #valide");

            objectError.innerHTML = "";
            if (courrielError) courrielError.innerHTML = "";
            messageError.innerHTML = "";
            OK.innerHTML = "";

            if (response.object) {
                if (courrielError)
                    objectError.innerHTML = response.object;
                objectInput.classList.add("KO");
            } else
                objectInput.classList.add("OK");

            if (response.courriel) {
                if (courrielError)
                    courrielError.innerHTML = response.courriel;
                courrielInput?.classList.add("KO");
            } else
                courrielInput?.classList.add("OK");

            if (response.message) {
                messageError.innerHTML = response.message;
                messageTextarea.classList.add("KO");
            } else
                messageTextarea.classList.add("OK");

            if (response.valide) {
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
}

function login() {
    let username = document.forms['login']['username']
    let password = document.forms['login']['password']

    let form = new FormData()
    form.append('ajax', true)
    form.append('username', username.value)
    form.append('password', password.value)

    let usernameError = document.querySelector("#login form div label #usernameError")
    let passwordError = document.querySelector("#login form div label #passwordError")
    let accountError = document.querySelector("#login form #accountError")
    let btn = document.getElementsByClassName('btn')[0]

    usernameError.innerHTML = ""
    passwordError.innerHTML = ""
    accountError.innerHTML = ""

    let xhr = new XMLHttpRequest()
    xhr.open('POST', './login')
    xhr.onreadystatechange = () => {
        if (xhr.responseText != null && xhr.status == 200 && xhr.readyState == 4) {
            let response = JSON.parse(xhr.responseText)

            username.classList.remove('OK', 'KO')
            password.classList.remove('OK', 'KO')
            btn.classList.remove('valide', 'error')

            console.log(response)

            if (response.username) {
                username.classList.add('KO')
                usernameError.innerText = response.username;
            } else
                username.classList.add('OK')

            if (response.password) {
                password.classList.add('KO')
                passwordError.innerText = response.password;
            } else
                password.classList.add('OK')

            if (response.valide) {
                btn.classList.add('valide')
                window.location.replace("./")
            } else if (response.account) {
                username.classList.add('KO')
                password.classList.add('KO')
                accountError.innerHTML = response.account
                btn.classList.add('error')
            }
        }
    };
    xhr.send(form)
}

function dashboard() {
    document.querySelectorAll("#dashboard nav ul div div a:nth-child(2)")?.forEach((e) => {
        e.addEventListener('click', () => {
            let p = e.parentNode.parentNode;
            document.querySelectorAll("#" + p.id + " .submenu")?.forEach((e) => {
                e.classList.toggle("OK");
            })
        });
    });

    document.querySelectorAll("#dashboard nav > ul > div > div > a:nth-child(2)")?.forEach((e) => {
        e.addEventListener('click', () => {
            e.classList.toggle("active");
        });
    });

    document.querySelectorAll("#dashboard nav ul > div > div a:first-child")?.forEach((e) => {
        e.addEventListener('click', () => {
            window.history.pushState({}, document.title, "/dashboard/" + e.dataset.subpage)

            let xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.pathname)
            xhr.onreadystatechange = () => {
                if (xhr.responseText && xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('subpage').innerHTML = xhr.responseText
                }
            }

            let form = new FormData()
            form.append('ajax', true)

            xhr.send(form)
        });
    });

    document.querySelectorAll("#dashboard nav ul > div > ul a")?.forEach((e) => {
        e.addEventListener('click', () => {
            window.history.pushState({}, document.title, "/dashboard/" + e.dataset.subpage)

            let xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.pathname)
            xhr.onreadystatechange = () => {
                if (xhr.responseText && xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('subpage').innerHTML = xhr.responseText
                }
            }

            let form = new FormData()
            form.append('ajax', true)

            xhr.send(form)
        });
    });
}

function internshipInterest() {
    document.querySelector("#internship > div input")?.addEventListener('click', () => {
        let xhr = new XMLHttpRequest();

        let id = window.location.pathname.split('/')[2];
        console.log(id)
        xhr.open('POST', '/internship/' + id)
        xhr.onreadystatechange = () => {
            if (xhr.responseText && xhr.readyState == 4 && xhr.status == 200) {
                let response = JSON.parse(xhr.response);

                if (response.valide) {
                    document.querySelector("#internship > div input").value = response.text;
                    document.querySelector("#internship > div input").classList.toggle('KO');
                }
            }
        }

        let form = new FormData();
        form.append('ajax', true);

        if (document.querySelector("#internship > div input").classList.contains('KO'))
            form.append('type', 'ni');
        else
            form.append('type', 'i');

        xhr.send(form)
    });
}

function dt_studentsearch() {
    let searchbar = document.querySelector('#dt_student #searchbar input');
    let results = document.getElementById('presumedresult');
    results.innerHTML = null

    if (searchbar.value.length >= 3) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/dashboard/student')
        xhr.onreadystatechange = () => {
            if (xhr.responseText && xhr.status == 200 && xhr.readyState == 4) {
                const nbData = 5
                const r = JSON.parse(xhr.responseText)
                const a = Object.values(r)
                const nbStudents = a.length / nbData

                for (let i = 0; i < nbStudents; i++) {
                    let div = document.createElement('div')
                    div.dataset.id = a[(i * nbData)]
                    div.addEventListener('click', () => {
                        let xhr = new XMLHttpRequest()
                        xhr.open('POST', '/dashboard/student')
                        xhr.onreadystatechange = () => {
                            if (xhr.responseText && xhr.status == 200 && xhr.readyState == 4) {
                                let response = JSON.parse(xhr.responseText)

                                let infos = document.getElementById('infos')
                                infos.innerHTML = null

                                let h3 = document.createElement('h3')
                                h3.id = "name"
                                h3.innerText = response.lastname.toUpperCase() + " " + response.firstname.charAt(0).toUpperCase() + response.firstname.slice(1) + ", " + response.classe
                                infos.insertAdjacentElement('beforeend', h3)

                                let div = document.createElement('div')
                                infos.insertAdjacentElement('beforeend', div)

                                let div1 = document.createElement('div')
                                div.insertAdjacentElement('beforeend', div1)

                                let img = document.createElement('img')
                                img.id = "profilpicture"
                                img.src = "//via.placeholder.com/200" // "/picture/" + response.profilpicture
                                img.alt = "PP"
                                div1.insertAdjacentElement('beforeend', img)

                                let p = document.createElement('p')
                                p.id = "stat"
                                p.innerText = response.stat
                                div1.insertAdjacentElement('beforeend', p)

                                let div2 = document.createElement('div')
                                div.insertAdjacentElement('beforeend', div2)

                                if (response.cv) {
                                    let a = document.createElement('a')
                                    a.id = "cv"
                                    a.href = "/file/" + response.cv
                                    a.target = "_blank"
                                    div2.insertAdjacentElement('beforeend', a)

                                    let img2 = document.createElement('img')
                                    img2.src = "/picture/cv.png"
                                    img2.alt = "CV"
                                    a.insertAdjacentElement('beforeend', img2)
                                }

                                if (response.lm) {
                                    let a2 = document.createElement('a')
                                    a2.id = "lm"
                                    a2.href = "/file/" + response.lm
                                    a2.target = "_blank"
                                    div2.insertAdjacentElement('beforeend', a2)

                                    let img3 = document.createElement('img')
                                    img3.src = "/picture/lm.png"
                                    img3.alt = "LM"
                                    a2.insertAdjacentElement('beforeend', img3)
                                }
                            }
                        }

                        let form = new FormData()
                        form.append('ajax', true)
                        form.append('id', div.dataset.id)

                        xhr.send(form)
                    })

                    let img = document.createElement('img')
                    img.alt = "PP"
                    // img.src = "/picture/"+a[((i * nbData) + 3)]
                    img.src = "//via.placeholder.com/50"

                    let sdiv = document.createElement('div')

                    div.insertAdjacentElement('afterbegin', sdiv)
                    div.insertAdjacentElement('afterbegin', img)

                    let pf = document.createElement('p')
                    pf.innerText = a[((i * nbData) + 1)]

                    let pl = document.createElement('p')
                    pl.innerText = a[((i * nbData) + 2)]

                    sdiv.insertAdjacentElement('afterbegin', pf)
                    sdiv.insertAdjacentElement('afterbegin', pl)

                    results.insertAdjacentElement('beforeend', div)
                }
            }
        }

        let form = new FormData()
        form.append('ajax', true)
        form.append('value', searchbar.value)

        xhr.send(form)
    }
}

function createInternship(e){
    e.preventDefault()

    let designation = document.forms['createinternship']['designation'].value
    let sdescription = document.forms['createinternship']['shortdescription'].value
    let description = document.forms['createinternship']['description'].value
    let classe = document.forms['createinternship']['class'].value
    let enterprise = document.forms['createinternship']['enterprise'].value
    let website = document.forms['createinternship']['website'].value
    let phone = document.forms['createinternship']['phone'].value
    let email = document.forms['createinternship']['email'].value    

    let form = new FormData()
    form.append('ajax', true)
    form.append('internship-1', true)
    form.append('designation', designation)
    form.append('sdescription', sdescription)
    form.append('description', description)
    form.append('class', classe)
    form.append('enterprise', enterprise)
    form.append('website', website)
    form.append('phone', phone)
    form.append('email', email)

    let xhr = new XMLHttpRequest()
    xhr.open('POST', "/dashboard/internship/create")
    xhr.onreadystatechange = () => {
        if (xhr.responseText && xhr.status == 200 && xhr.readyState == 4){
            let response = JSON.parse(xhr.responseText)

            document.getElementById('designationError').innerText = response?.designation || null
            document.getElementById('sdescriptionError').innerText = response?.sdescription || null
            document.getElementById('descriptionError').innerText = response?.description || null
            document.getElementById('classError').innerText = response?.class || null
            document.getElementById('enterpriseError').innerText = response?.enterprise || null
            document.getElementById('sitewebError').innerText = response?.siteweb || null
            document.getElementById('phoneError').innerText = response?.phone || null
            document.getElementById('emailError').innerText = response?.email || null
            document.getElementById('errError').innerText = response?.err || null
        }
    }
    xhr.send(form)
}

function modifyInternship(e, id){
    e.preventDefault()

    let designation = document.getElementById('designation').value
    let sdescription = document.getElementById('shortdescription').value
    let description = document.getElementById('description').value
    let classe = document.querySelector('form #class').value
    let enterprise = document.getElementById('enterprise').value
    let website = document.getElementById('website').value
    let phone = document.getElementById('phone').value
    let email = document.getElementById('email').value

    let xhr = new XMLHttpRequest()
    xhr.open('POST', "/dashboard/internship/modify")
    xhr.onreadystatechange = () => {
        if (xhr.responseText && xhr.status === 200 && xhr.readyState === xhr.DONE){
            let response = JSON.parse(xhr.responseText)

            console.log(response)
        }
    }

    let form = new FormData()
    form.append('ajax', true)
    form.append('internship-1', true)
    form.append('designation', designation)
    form.append('sdescription', sdescription)
    form.append('description', description)
    form.append('class', classe)
    form.append('enterprise', enterprise)
    form.append('website', website)
    form.append('phone', phone)
    form.append('email', email)
    form.append('id', id)

    xhr.send(form)
}

// console.clear()