const usernameInput = document.getElementById("username-input");
const emailInput = document.getElementById("email-input");
const passwordInput = document.getElementById("password-input");
const submitBtn = document.getElementById("submit-button");

let usernameUnique = false;
let registerUnique = false;

const debounce = (cb, time) => {
    let timeoutId = null;
    const func = () => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(cb,time);
    }

    return func;
}

const usernameValidate = debounce(() => {
    const xhr = new XMLHttpRequest();

    xhr.onloadend = function() {
        const unique = this.responseText;

        if(unique === "unique") {
            usernameInput.style = "border: 1px ridge #0F0";
            usernameUnique = true;
        } else {
            usernameUnique = false;
        }
    }

    xhr.open("GET", `/server/register/validate.php?name=${usernameInput.value}`);

    xhr.send();
}, 500);

usernameInput.onkeydown = () => {
    usernameValidate();
}

const emailValidate = debounce(() => {
    const xhr = new XMLHttpRequest();

    xhr.onloadend = function() {
        const unique = this.responseText;

        if(unique === "unique") {
            emailInput.style = "border: 1px ridge #0F0";
            emailUnique = true;
        } else {
            emailUnique = false;
        }
    }

    xhr.open("GET", `/server/register/validate.php?email=${emailInput.value}`);

    xhr.send();
}, 500);

emailInput.onkeydown = () => {
    emailValidate();
}

submitBtn.onclick = () => {
    if(!(usernameUnique && emailUnique)) {
        alert("username and/or email invalid");
        return;
    }

    const xhr = new XMLHttpRequest();

    xhr.onloadend = function() {
        const result = this.responseText;

        alert(result);

    }

    xhr.open("POST", "/server/register/index.php", true);

    xhr.setRequestHeader("Content-Type", "application/json");

    const reqJson = {
        "username": usernameInput.value,
        "email": emailInput.value,
        "password": passwordInput.value
    };

    xhr.send(JSON.stringify(reqJson));
}