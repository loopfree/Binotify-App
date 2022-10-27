window.onload = () => {
    getNav();
    getSongCards();
    getProfile();
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

function getSongCards() {
    const songContainer = document.getElementById("songs-container");
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/server/home/index.php", true);
    xhr.onload = function() {
        songContainer.innerHTML = this.responseText;
        songPlayUpdate();
    }
    xhr.send(null);
}

function getProfile() {
    const profile = document.getElementById("profile");
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/server/home/profile.php`);
    xhr.onload = function() {
        profile.innerHTML = this.responseText;
    }
    xhr.send();
}

function songPlayUpdate() {
    const songCards = document.getElementsByClassName("song-card");

    for (let i=0; i < songCards.length; i++) {
        const songCard = songCards[i];
        songCard.addEventListener("mouseenter", function() {
            const playButton = songCard.querySelector(".play-button");
            playButton.style.opacity = "100%";
            playButton.style.transform = "translateY(0)";
        })
        songCard.addEventListener("mouseleave", function() {
            const playButton = songCard.querySelector(".play-button");
            playButton.style.opacity = "0";
            playButton.style.transform = "translateY(0.5rem)";
        })
    }
}