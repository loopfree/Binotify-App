const username = document.getElementById("username-input");
const password = document.getElementById("password-input");

const submitBtn = document.getElementById("button-submit");

submitBtn.onclick = () => {
    const xhr = new XMLHttpRequest();

    xhr.onloadend = function() {
        console.log(this.responseText);
        const json = JSON.parse(this.responseText);

        console.log(json);

        if(json["success"] === "true") {
            window.localStorage.setItem("user-id", json["user-id"]);
        } else {
            alert("Login fail");
        }
    }

    xhr.open("POST", "/server/login/index.php", true);

    xhr.setRequestHeader("Content-Type", "application/json");

    const json = {
        "username": username.value,
        "password": password.value
    }

    xhr.send(JSON.stringify(json));
}