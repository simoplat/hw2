const formStatus = {
    name: false,
    surname: false,
    username: false,
    email: false,
    password: false,
    confirmPassword: false,
    allow: false,
    upload: true // o false, se deve essere controllato in qualche modo
};


// Funzione generica per campi "name" e "surname"
function checkNotEmpty(event) {
    const input = event.currentTarget;
    const isValid = input.value.trim().length > 0;
    formStatus[input.name] = isValid;
    input.parentNode.classList.toggle('errorj', !isValid);
}

// Username: verifica regex
function checkUsername(event) {
    const input = event.currentTarget;
    const regex = /^[a-zA-Z0-9_]{1,15}$/;
    const isValid = regex.test(input.value);
    const errorSpan = input.parentNode.querySelector('span');
    if (!isValid) {
        errorSpan.textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
    } else {
        errorSpan.textContent = "";
    }
    formStatus.username = isValid;
    input.parentNode.classList.toggle('errorj', !isValid);
}

// Email: verifica regex
function checkEmail(event) {
    const input = event.currentTarget;
    const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const isValid = regex.test(String(input.value).toLowerCase());
    const errorSpan = input.parentNode.querySelector('span');
    if (!isValid) {
        errorSpan.textContent = "Email non valida";
    } else {
        errorSpan.textContent = "";
    }
    formStatus.email = isValid;
    input.parentNode.classList.toggle('errorj', !isValid);
}

// Password: almeno 8 caratteri
function checkPassword(event) {
    const input = event.currentTarget;
    const isValid = input.value.length >= 8;
    formStatus.password = isValid;
    input.parentNode.classList.toggle('errorj', !isValid);
}

// Conferma password: deve coincidere
function checkConfirmPassword(event) {
    const input = event.currentTarget;
    const password = document.querySelector('.password input').value;
    const isValid = input.value === password;
    formStatus.confirmPassword = isValid;
    input.parentNode.classList.toggle('errorj', !isValid);
}

// Controllo checkbox "allow"
function checkAllow(event) {
    const input = event.currentTarget;
    formStatus[input.name] = input.checked;
}

// Submit finale: blocca se un campo è falso o mancante
function checkSignup(event) {
    console.log("Stato form al submit:", formStatus);
    if (Object.keys(formStatus).length !== 8 || Object.values(formStatus).includes(false)) {
        event.preventDefault();
        console.log("Submit bloccato per campi non validi.");
    }
}

// Aggiunta event listeners
document.querySelector('.name input').addEventListener('blur', checkNotEmpty);
document.querySelector('.surname input').addEventListener('blur', checkNotEmpty);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);
document.querySelector('.allow input').addEventListener('change', checkAllow);
document.querySelector('form').addEventListener('submit', checkSignup);
