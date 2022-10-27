window.onload = () => {
    getNav();
    getAlbumCards();
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

function getAlbumCards() {
    const albumContainer = document.getElementById("album-container");
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/server/album-list/index.php", true);
    xhr.onload = function() {
        albumContainer.innerHTML = this.responseText;
        albumUpdate();
    }
    xhr.send();
}

function albumUpdate() {
    const albumCards = document.getElementsByClassName("album-card");

    for (let i=0; i < albumCards.length; i++) {
        const albumCard = albumCards[i];
        albumCard.addEventListener("mouseenter", function() {
            const playButton = albumCard.querySelector(".play-button");
            playButton.style.opacity = "100%";
            playButton.style.transform = "translateY(0)";
        })
        albumCard.addEventListener("mouseleave", function() {
            const playButton = albumCard.querySelector(".play-button");
            playButton.style.opacity = "0";
            playButton.style.transform = "translateY(0.5rem)";
        })
        albumCard.addEventListener("click", function() {
            window.location.href = "/page/album-detail/index.php?album-id=" + albumCard.getAttribute("album-id");
        })
    }
}