window.onload = () => {
    const userId = window.localStorage.getItem("user-id");

    let addition = "";

    if(userId !== null) {
        addition = `?user-id=${userId}`;
    }
    
    const nav = document.getElementsByClassName('nav')[0];
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/server/nav/nav.php${addition}`);
    xhr.onload = function() {
        nav.innerHTML = this.responseText;
    }
    xhr.send();
}

var modal = document.getElementById("edit-modal");

var btn = document.getElementById("edit-btn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
    console.log("clicked")
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}