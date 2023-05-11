const emailInputUI = document.getElementById('login-email');
const emailErrorUI = document.getElementById('email-error');
const passwordInputUI = document.getElementById('login-password');
const passwordErrorUI = document.getElementById('password-error');
const passwordConfirmInputUI = document.getElementById('login-password-confirm');
const loginFormUI = document.getElementById('login-form');
const registerFormUI = document.getElementById('register-form');
console.log("fsfs");
// Applies only if login form is available
loginFormUI?.addEventListener('submit', (e) => {
    let isValid = true;
    if (!validateEmail(emailInputUI.value)) {
        isValid = false;
    }

    if (!validatePassword(passwordInputUI.value)) {
        isValid = false;
    }

    if(!isValid) {
        e.preventDefault();
    }
});

// Applies only if registration form is available
registerFormUI?.addEventListener('submit', (e) => {
    let isValid = true;
    if (!validateEmail(emailInputUI.value)) {
        isValid = false;
    }

    if (!validatePassword(passwordInputUI.value, passwordConfirmInputUI)) {
        isValid = false;
    }

    if(!isValid) {
        e.preventDefault();
    }
});


function validateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
        emailErrorUI.innerText = "";
        return true;
    }
    emailErrorUI.innerText = "Please enter a valid email";
    passwordInputUI.value = "";
    if(passwordConfirmInputUI) passwordConfirmInputUI.value = "";
    return false;
}

function validatePassword(pass, confirmPass = false) {
    if(pass.length < 4) {
        passwordErrorUI.innerText = "Password should be at least 4 characters long";
        passwordInputUI.value = "";
        if(passwordConfirmInputUI) passwordConfirmInputUI.value = "";
        return false;

    } else if(confirmPass && pass !== confirmPass){
        passwordErrorUI.innerText = "Please confirm the password";
        passwordInputUI.value = "";
        passwordConfirmInputUI.value = "";
        return false;
    } else {
        passwordErrorUI.innerText = "";
        return true;
    }
}