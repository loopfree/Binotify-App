var albumId = document.getElementsByTagName("main")[0].getAttribute("album-id");
var editModal = document.getElementById("edit-modal");
var editButton = document.getElementsByClassName("settings-button")[0];
var editClose = document.getElementsByClassName("close")[0];
var deleteModal = document.getElementById("delete-modal");
var deleteButton = document.getElementsByClassName("settings-button")[1];
var deleteClose = document.getElementsByClassName("close")[1];

window.onload = () => {
    getNav();
    getAlbumInfo();
}

window.onclick = function(event) {
    if (event.target === editModal) {
        editModal.style.display = "none";
    }
    else if (event.target === deleteModal) {
        deleteModal.style.display = "none";
    }
}

function getNav() {
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

function getAlbumInfo() {
    const albumImage = document.getElementsByClassName('album-image-container')[0].firstElementChild;
    const albumTitle = document.getElementsByClassName('album-title')[0].firstElementChild;
    const albumDesc = document.getElementsByClassName('album-desc')[0].firstElementChild;
    const albumSongList = document.getElementsByClassName('song-list')[0];
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/server/album-detail/index.php?album-id='+albumId);
    xhr.onload = function() {
        var json = JSON.parse(this.responseText);
        console.log(json);
        albumImage.src = json["imgpath"];
        albumTitle.innerHTML = json["title"];
        albumDesc.innerHTML = `${json["artist"]} • ${json["genre"]}, ${json["duration"]} seconds`;
        albumSongList.innerHTML = json["song-list-html"];
    }
    xhr.send();
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
