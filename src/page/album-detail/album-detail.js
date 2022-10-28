var albumId = document.getElementsByTagName("main")[0].getAttribute("album-id");
var editModal = document.getElementById("edit-modal");
var editButton = document.getElementsByClassName("settings-button")[0];
var editClose = document.getElementsByClassName("close")[0];
var deleteModal = document.getElementById("delete-modal");
var deleteButton = document.getElementsByClassName("settings-button")[1];
var confirmDeleteButton = document.getElementsByClassName("confirm-button")[0];
var cancelDeleteButton = document.getElementsByClassName("cancel-button")[0];

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
    const nav = document.getElementsByClassName('nav')[0];
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/server/nav/nav.php`);
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
        albumImage.src = json["imgpath"];
        albumTitle.innerHTML = json["title"];
        albumDesc.innerHTML = `${json["artist"]} • ${json["genre"]}, ${secToString(json["duration"])}`;
        albumSongList.innerHTML = json["song-list-html"];
        var admin = json["admin"];
        console.log(admin);
        if (!admin) {
            const removeButtons = document.getElementsByClassName("remove-button");
            for (let i=0; i < removeButtons.length; i++) {
                const removeButton = removeButtons[i];
                removeButton.style.display = "none";
            }
        }
        updateSongList();
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

confirmDeleteButton.onclick = function() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/server/album-detail/delete-album.php?album-id='+albumId);
    xhr.onload = function() {
        window.location.href = '/page/album-list/';
    }
    xhr.send();
}

cancelDeleteButton.onclick = function() {
    deleteModal.style.display = "none";
}

function secToString(t) {
    if (t >= 3600) {
        return `${Math.floor(t/3600)} hr ${(t%3600)%60} min`;
    }
    else {
        return `${Math.floor(t/60)} min ${t%60} sec`;
    }
}

function updateSongList() {
    const removeButtons = document.getElementsByClassName("remove-button");
    for (let i=0; i < removeButtons.length; i++) {
        const removeButton = removeButtons[i];
        removeButton.addEventListener("click", function(event) {
            event.stopPropagation();
            window.location.href = `/server/album-detail/delete-song.php?album-id=${albumId}&song-id=${removeButton.getAttribute("song-id")}`;
    });
    }
    
    const songBoxes = document.getElementsByClassName("song");
    for (let i=0; i < songBoxes.length; i++) {
        const songBox = songBoxes[i];
        songBox.addEventListener("click", function() {
            window.location.href = `/page/detail-lagu/index.php?song-id=${songBox.getAttribute("song-id")}`;
        });
    }
}