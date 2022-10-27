var editModal = document.getElementById("edit-modal");
var editButton = document.getElementsByClassName("settings-button")[0];
var editClose = document.getElementsByClassName("close")[0];
var deleteModal = document.getElementById("delete-modal");
var deleteButton = document.getElementsByClassName("settings-button")[1];
var deleteClose = document.getElementsByClassName("close")[1];

window.onload = () => {
    const nav = document.getElementsByClassName('nav')[0];
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/server/nav/nav.php');
    xhr.onload = function() {
        nav.innerHTML = this.responseText;
    }
    xhr.send();
}

window.onclick = function(event) {
    if (event.target === editModal) {
        editModal.style.display = "none";
    }
    else if (event.target === deleteModal) {
        deleteModal.style.display = "none";
    }
}

editButton.onclick = function() {
    editModal.style.display = "block";
}

editClose.onclick = function() {
    editModal.style.display = "none";
}

deleteButton.onclick = function() {
    deleteModal.style.display = "block";
}

deleteClose.onclick = function() {
    deleteModal.style.display = "none";
}
