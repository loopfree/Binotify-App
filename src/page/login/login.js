const username = document.getElementById("username-input");
const password = document.getElementById("password-input");

const submitBtn = document.getElementById("button-submit");

if(window.localStorage.getItem("user-id") !== null) {
    const redirectForm = document.createElement("form");

    redirectForm.action = "/index.php";
    redirectForm.method = "POST";

    const userId = document.createElement("input");

    userId.type = "hidden";
    userId.name = "user-id";
    userId.value = window.localStorage.getItem("user-id");

    redirectForm.appendChild(userId);

    document.body.appendChild(redirectForm);

    redirectForm.submit();
}


submitBtn.onclick = () => {
    const xhr = new XMLHttpRequest();

    xhr.onloadend = function() {
        console.log(this.responseText);
        const json = JSON.parse(this.responseText);

        console.log(json);

        if(json["success"] === "true") {
            window.localStorage.setItem("user-id", json["user-id"]);

            const redirectForm = document.createElement("form");

            redirectForm.action = "/index.php";
            redirectForm.method = "POST";
            
            const userId = document.createElement("input");

            userId.type = "hidden";
            userId.name = "user-id";
            userId.value = json["user-id"];
            
            redirectForm.appendChild(userId);

            document.body.appendChild(redirectForm);

            redirectForm.submit();
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