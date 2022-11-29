window.onload = () => {
    getNav();
    getSongCards();
    getProfile();
}

async function getSongsList() {
    const response = await fetch("http://localhost:3000/premium_singer/list");
    return await response.json();
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
    // Fetch data
    getSongsList().then((results) => {
        if(results !== null)  {
            results.forEach((result) => {
                const songCard = document.createElement("div");
                songCard.className = "song-card";
                songCard.innerHTML = `
                    <img 
                        src='$imgpath'
                        alt='$title'
                        class='song-image'
                    >
                    <div class='song-info'>
                        <h2 class='song-title'>${result.judul}</h2>
                    </div>
                    <div class='play-button'>
                        <div class='triangle'></div>
                    </div>
                `;
                songContainer.appendChild(songCard);
            });
            songPlayUpdate();
        } else {
            songContainer.innerHTML = `<p class="text-center">No premium songs available</p>`;
        }
    });
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
        songCard.addEventListener("click", function() {
            window.location.href = `/page/detail-lagu/index.php?song-id=${songCard.getAttribute("song-id")}`;
        })
    }
}