const meta_element = document.querySelector('meta[name="csrf-token"');
const csrf_token = meta_element.content;

const formStatus = {
    name: false,
    surname: false,
    username: false,
    email: false,
    password: false,
    confirmPassword: false,
    allow: false,
    upload: true 
};

function checkNotEmpty(event) {
    const input = event.currentTarget || event;
    const isValid = input.value.trim().length > 0;
    formStatus[input.name] = isValid;
    input.parentNode.classList.toggle('errorj', !isValid);
}

function checkUsername(event) {
    const input = event.currentTarget || event;
    const regex = /^[a-zA-Z0-9_]{1,15}$/;
    const isValid = regex.test(input.value);

    const data = new FormData();
    data.append('username', input.value);
    console.log(input.value);
    data.append('_token', csrf_token);
    if (isValid) {
        console.log('Faccio la fetch '+ input.value);
        fetch('checkUsername', {
            method: 'POST',
            body: data,
        }).then(onResponse).then(onjson);
    }

    const errorSpan = input.parentNode.querySelector('span');
    errorSpan.id = "errorUsername";
    errorSpan.textContent = isValid ? "" : "Sono ammesse lettere, numeri e underscore. Max. 15";
    formStatus.username = isValid;
    input.parentNode.classList.toggle('errorj', !isValid);
}

function onResponse(response) {
    if (!response.ok) {
        return null;
    }
    return response.json();
}

function onjson(json) {
    if (!json) return;

    if (json.exists) {
        if (json.type === 'email') {
            const errorElement = document.getElementById('errorEmail');
            if (errorElement) {
                errorElement.textContent = "Email già esistente";
                errorElement.parentNode.classList.add('errorj');
                document.querySelector('.email').classList.add('errorj');
                formStatus.email = false; 
            }
        } else if (json.type === 'username') {
            const errorElement = document.getElementById('errorUsername'); 
            if (errorElement) {
                errorElement.textContent = "Username già esistente";
                errorElement.parentNode.classList.add('errorj');
                document.querySelector('.username').classList.add('errorj');
                formStatus.username = false;
            }
        }
    } else {
        if (json.type === 'email') {
            const errorElement = document.getElementById('errorEmail');
            if (errorElement) {
                errorElement.textContent = "";
                errorElement.parentNode.classList.remove('errorj');
                formStatus.email = true;
            }
        } else if (json.type === 'username') {
            const errorElement = document.getElementById('errorUsername');
            if (errorElement) {
                errorElement.textContent = "";
                errorElement.parentNode.classList.remove('errorj');
                formStatus.username = true;
            }
        }
    }
}

function checkEmail(event) {
    const input = event.currentTarget || event;
    const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const isValid = regex.test(String(input.value).toLowerCase());

    const data = new FormData();
    data.append('email', input.value);
    data.append('_token', csrf_token);
    if (isValid) {
        console.log('Faccio la fetch '+ input.value);
        fetch('checkEmail', {
            method: 'POST',
            body: data,
        }).then(onResponse).then(onjson);
    }
    

    const errorSpan = input.parentNode.querySelector('span');
    errorSpan.id= "errorEmail";
    errorSpan.textContent = isValid ? "" : "Email non valida";
    formStatus.email = isValid;
    input.parentNode.classList.toggle('errorj', !isValid);
}

function checkPassword(event) {
    const input = event.currentTarget || event;
    const isValid = input.value.length >= 8;
    formStatus.password = isValid;
    input.parentNode.classList.toggle('errorj', !isValid);
}

function checkConfirmPassword(event) {
    const input = event.currentTarget || event;
    const password = document.querySelector('.password input').value;
    const isValid = input.value === password;
    formStatus.confirmPassword = isValid;
    input.parentNode.classList.toggle('errorj', !isValid);
}

function checkAllow(event) {
    const input = event.currentTarget || event;
    formStatus[input.name] = input.checked;
}

function checkSignup(event) {
    console.log("Stato form al submit:", formStatus);
    if (Object.values(formStatus).includes(false)) {
        event.preventDefault();
        console.log("Submit bloccato per campi non validi.");
    }
}

document.querySelector('.name input').addEventListener('blur', checkNotEmpty);
document.querySelector('.surname input').addEventListener('blur', checkNotEmpty);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);
document.querySelector('.allow input').addEventListener('change', checkAllow);
document.querySelector('form').addEventListener('submit', checkSignup);

function validaInput() {
    const inputsToCheck = [
        { selector: '.name input', fn: checkNotEmpty },
        { selector: '.surname input', fn: checkNotEmpty },
        { selector: '.username input', fn: checkUsername },
        { selector: '.email input', fn: checkEmail },
        { selector: '.password input', fn: checkPassword },
        { selector: '.confirm_password input', fn: checkConfirmPassword },
        { selector: '.allow input', fn: checkAllow }
    ];

    for (let i = 0; i < inputsToCheck.length; i++) {
        let selector = inputsToCheck[i].selector;
        let fn = inputsToCheck[i].fn;
        let input = document.querySelector(selector);
        if (input && input.value !== "") {
            fn(input);
        }
    }

    const errorElement = document.querySelector('h1.hidden');
    if (errorElement && errorElement.textContent === 'username') {
        console.log("Errore trovato: username");
        document.querySelector('.username input').focus();
        document.querySelector('.username input').parentNode.classList.add('errorj');
    } else if( errorElement && errorElement.textContent === 'email') {
        console.log("Errore trovato: email");
        document.querySelector('.email input').focus();
        document.querySelector('.email input').parentNode.classList.add('errorj');
    }
}

validaInput();
