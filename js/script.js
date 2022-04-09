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

    let form = document.forms['contact']

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./contact", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);

            let objectInput = form['object'];
            let courrielInput = form['courriel'];
            let messageTextarea = form['message'];

            objectInput.classList.remove("OK", "KO");
            courrielInput?.classList.remove("OK", "KO");
            messageTextarea.classList.remove("OK", "KO");

            let objectError = document.getElementById("objectError");
            let courrielError = document.getElementById("courrielError");
            let messageError = document.getElementById("messageError");
            let OK = document.getElementById("valide");

            objectError.innerHTML = "";
            if (courrielError) courrielError.innerHTML = "";
            messageError.innerHTML = "";
            OK.innerHTML = "";

            if (response.object) {
                objectError.innerHTML = response?.object;
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

    let nform = new FormData(form);
    nform.append("ajax", true);

    xhr.send(nform);
}

function login() {
    let usernameError = document.getElementById("usernameError")
    let passwordError = document.getElementById("passwordError")
    let accountError = document.getElementById("accountError")
    let btn = document.getElementsByClassName('btn')[0]

    usernameError.innerText = ""
    passwordError.innerText = ""
    accountError.innerText = ""

    let form = document.forms['login']

    let username = form['username']
    let password = form['password']

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

    let nform = new FormData(form)
    nform.append('ajax', true)

    xhr.send(nform)
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

function createInternship(e, form){
    e.preventDefault()

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

    let nform = new FormData(form)
    nform.append('ajax', true)
    nform.append('internship-1', true)

    xhr.send(nform)
}

function modifyInternship(e, id, form){
    e.preventDefault()

    let xhr = new XMLHttpRequest()
    xhr.open('POST', "/dashboard/internship/modify")
    xhr.onreadystatechange = () => {
        if (xhr.responseText && xhr.status === 200 && xhr.readyState === xhr.DONE){
            let response = JSON.parse(xhr.responseText)

            console.log(response)
        }
    }

    let nform = new FormData(form)
    nform.append('ajax', true)
    nform.append('internship-1', true)
    nform.append('id', id)

    xhr.send(nform)
}

function createClass(e, form){
    e.preventDefault()

    let xhr = new XMLHttpRequest()
    xhr.open('POST', "/dashboard/class/create")
    xhr.onreadystatechange = () => {
        if (xhr.status === 200 && xhr.responseText && xhr.readyState === 4){
            let response = JSON.parse(xhr.responseText)

            document.getElementById('designationError').innerText = response?.designation || null
            Array.from(document.getElementsByClassName('dateError')).forEach(element => {
                element.innerText = response?.date || null
            });

            let validation = document.querySelector('#class_create .formValidation')

            validation.classList.remove('OK', 'KO')

            if (response.valide){
                validation.classList.add('OK')
                validation.innerText = response.valide || null
            }else if (response.error){
                validation.classList.add('KO')
                validation.innerText = response.error || null
            }

            console.log(response)
        }
    }
        
    let nform = new FormData(form)
    nform.append('ajax', true)
    nform.append('class/create', true)

    xhr.send(nform)
}

function createClassFile(e, form){
    e.preventDefault()

    let xhr = new XMLHttpRequest()
    xhr.open('POST', "/dashboard/class/create")
    xhr.onreadystatechange = () => {
        if (xhr.response && xhr.status === 200 && xhr.readyState === 4){
            let response = JSON.parse(xhr.response)

            console.log(response)
        }
    }

    let nform = new FormData(form)
    nform.append('ajax', true)
    nform.append('class/createFile', true)

    xhr.send(nform)
}

function selectClassModify(select){
    let xhr = new XMLHttpRequest()
    xhr.open('POST', "/dashboard/class/modify")
    xhr.onreadystatechange = () => {
        if (xhr.responseText && xhr.status === 200 && xhr.readyState === 4){
            let response = JSON.parse(xhr.responseText)

            let form = document.forms['class_modify']

            form['designation'].value = response.designation
            form['start_date'].value = (response.stageStart?.search("1970")) ? response.stageStart : null
            form['end_date'].value = (response.stageEnd?.search("1970")) ? response.stageEnd : null

            Array.from(document.forms['class_modify']['teacher'].children[1].children)[0].setAttribute('selected', null)

            Array.from(document.forms['class_modify']['teacher'].children[1].children).forEach(e => {
                if (e.value == response.idTeacher)
                    e.setAttribute('selected', null)
                else
                    e.removeAttribute('selected')
            })
        }
    }

    let form = new FormData()
    form.append('ajax', true)
    form.append('selectClass', true)
    form.append('id', select.value)

    xhr.send(form)
}

function modifyClass(e, form){
    e.preventDefault()

    let xhr = new XMLHttpRequest()
    xhr.open('POST', "/dashboard/class/modify")
    xhr.onreadystatechange = () => {
        if (xhr.responseText && xhr.status === 200 && xhr.readyState === 4){
            let response = JSON.parse(xhr.responseText)

            document.getElementById('designationError').innerText = response.designation || null
            Array.from(document.getElementsByClassName('dateError')).forEach(e => {
                e.innerText = response.date || null
            })

            let validation = document.querySelector('#class_modify .formValidation')

            validation.classList.remove('OK', 'KO')

            if (response.valide){
                validation.classList.add('OK')
                validation.innerText = response.valide || null
            }else if (response.error){
                validation.classList.add('KO')
                validation.innerText = response.error || null
            }
        }
    }
    
    let nform = new FormData(form)
    nform.append('ajax', true)
    nform.append('modifyClass', true)
    nform.append('id', document.getElementById('classes').value)

    xhr.send(nform)
}

function createTeacher(e, form){
    e.preventDefault()

    let xhr = new XMLHttpRequest()
    xhr.open('post', "/dashboard/teacher/add")
    xhr.onreadystatechange = () => {
        if (xhr.responseText && xhr.status === 200 && xhr.readyState === 4){
            let response = JSON.parse(xhr.responseText)

            document.getElementById('firstnameError').innerText = response?.firstname || null;
            document.getElementById('lastnameError').innerText = response?.lastname || null;

            let validation = document.querySelector('#teacher_create .formValidation')

            validation.classList.remove('OK', 'KO')

            if (response.valide){
                validation.classList.add('OK')
                validation.innerText = response.valide || null
            }else if (response.error){
                validation.classList.add('KO')
                validation.innerText = response.error || null
            }
        }
    }

    let nform = new FormData(form)
    nform.append('ajax', true)
    nform.append('addTeacher', true)

    xhr.send(nform)
}

function createTeacherFile(e, form){
    e.preventDefault()

    let xhr = new XMLHttpRequest()
    xhr.open('post', "/dashboard/teacher/add")
    xhr.onreadystatechange = () => {
        if (xhr.responseText && xhr.status === 200 && xhr.readyState === 4){
            let response = JSON.parse(xhr.responseText)

        }
    }

    let nform = new FormData(form)
    nform.append('ajax', true)
    nform.append('addTeacherFile', true)

    xhr.send(nform)
}

function searchTeacher(search){
    let items = document.getElementById('items')
    items.innerHTML = null
    
    if (search.value.length < 2) return;

    let x = 0;
    for (let i = 0; i < search.value.length; i++) {
        if (search.value[i] != ' ') break;
        else x++;
    }

    search.value = search.value.substring(x)

    if (search.value != ""){
        let xhr = new XMLHttpRequest()
        xhr.open('post', "/dashboard/teacher/modify")
        xhr.onreadystatechange = () => {
            if (xhr.responseText && xhr.status === 200 && xhr.readyState === 4){
                let response = JSON.parse(xhr.responseText)
    
                response.teachers.forEach(e => {
                    let div = document.createElement('div')
                    div.classList.add('item')
                    div.dataset.id = e.idteacher
                    div.addEventListener('click', () => {
                        let xhr = new XMLHttpRequest()
                        xhr.open('post', "/dashboard/teacher/modify")
                        xhr.onreadystatechange = () => {
                            if (xhr.responseText && xhr.status === 200 && xhr.readyState === 4){
                                let response = JSON.parse(xhr.responseText).teacher

                                let form = document.forms['teacher_modify']

                                form['firstname'].value = response.firstname
                                form['lastname'].value = response.lastname
                                form['username'].value = response.username
                                form['courriel'].value = response.courriel

                                form['id'].value = e.idteacher
                            }
                        }

                        let form = new FormData()
                        form.append('ajax', true)
                        form.append('teacherGetData', true)
                        form.append('id', e.idteacher)

                        xhr.send(form)
                    })
                    items.insertAdjacentElement('beforeend', div)
    
                    let h4 = document.createElement('h4')
                    h4.innerText = e.lastname + " " + e.firstname
                    div.insertAdjacentElement('beforeend', h4)
                })
            }
        }
    
        let form = new FormData()
        form.append('ajax', true)
        form.append('teacherSearch', true)
        form.append('s', search.value)
    
        xhr.send(form)
    }
}

function modifyTeacher(e, form){
    e.preventDefault()

    let xhr = new XMLHttpRequest()
    xhr.open('post', "/dashboard/teacher/modify")
    xhr.onreadystatechange = () => {
        if (xhr.responseText && xhr.status === 200 && xhr.readyState === 4){
            let response = JSON.parse(xhr.responseText)

            document.getElementById('firstnameError').innerText = response?.firstname || null;
            document.getElementById('lastnameError').innerText = response?.lastname || null;
            document.getElementById('usernameError').innerText = response?.username || null;
            document.getElementById('courrielError').innerText = response?.courriel || null;

            let validation = document.querySelector('#teacher_modify .formValidation')

            validation.classList.remove('OK', 'KO')

            if (response.success){
                validation.classList.add('OK')
                validation.innerText = response.success || null
            }else if (response.error){
                validation.classList.add('KO')
                validation.innerText = response.error || null
            }

            console.log(response)
        }
    }

    let nform = new FormData(form)
    nform.append('ajax', true)
    nform.append('teacherModify', true)

    xhr.send(nform)
}

function createStudent(e, form){
    e.preventDefault()

    let xhr = new XMLHttpRequest()
    xhr.open('post', "/dashboard/student/add")
    xhr.onreadystatechange = () => {
        if (xhr.responseText && xhr.status === 200 && xhr.readyState === 4){
            let response = JSON.parse(xhr.responseText)

            document.getElementById('firstnameError').innerText = response?.firstname || null;
            document.getElementById('lastnameError').innerText = response?.lastname || null;
            document.getElementById('classError').innerText = response?.class || null;

            let validation = document.querySelector('#student_create .formValidation')

            validation.classList.remove('OK', 'KO')

            if (response.success){
                validation.classList.add('OK')
                validation.innerText = response.success || null
            }else if (response.error){
                validation.classList.add('KO')
                validation.innerText = response.error || null
            }
        }
    }

    let nform = new FormData(form)
    nform.append('ajax', true)
    nform.append('studentAdd', true)

    xhr.send(nform)
}

function createStudentFile(e, form){
    e.preventDefault()

    let xhr = new XMLHttpRequest()
    xhr.open('post', "/dashboard/student/add")
    xhr.onreadystatechange = () => {
        if (xhr.responseText && xhr.status === 200 && xhr.readyState === 4){
            let response = JSON.parse(xhr.responseText)
            
        }
    }

    let nform = new FormData(form)
    nform.append('ajax', true)
    nform.append('studentAddFile', true)

    xhr.send(nform)
}

// console.clear()