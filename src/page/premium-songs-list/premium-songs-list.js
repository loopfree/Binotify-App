window.onload = () => {
    getNav();
    // getCreatorIds();
    getProfile();
    getSongCards();
}

async function getSongsList(creatorId) {
    const songContainer = document.getElementById("songs-container");
    const userId = songContainer.getAttribute("user_id");
    const token = document.cookie.split('; ')
        .find((row) => row.startsWith("token="))
        ?.split("=")[1];

    const response = await fetch(`http://localhost:3000/subscriber/${userId}/premium_song/${creatorId}`, {
        method: "GET",
        headers: {
            'Authorization': token === undefined ? "" : token
        },
    });
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

// function getCreatorIds() {
//     const songContainer = document.getElementById("songs-container");
//     const xhr = new XMLHttpRequest();
//     xhr.open("GET", "/server/premium-songs-list/index.php", true);
//     xhr.onload = function() {
//         songContainer.innerHTML = this.responseText;
//     }
//     xhr.send(null);
// }

// function getSongCards() {
//     const songContainer = document.getElementById("songs-container");
//     const xhr = new XMLHttpRequest();
//     xhr.open("GET", "/server/premium-songs-list/index.php", true);
//     xhr.onload = function() {
//         songContainer.innerHTML = this.responseText;
//         songPlayUpdate();
//     }
//     xhr.send(null);
// }

function getSongCards() {
    const songContainer = document.getElementById("songs-container");
    // const creatorId = songContainer.getAttribute("creator_id");
    // console.log(creatorIdFields);
    // const userId = songContainer.getAttribute("user_id");
    let audio = new Audio();
    // Fetch data
    // for(let i=0; i < creatorIdFields.length; i++) {
    //     const creatorId = creatorIdFields[i].getAttribute("creator_id");
    getSongsList(creatorId).then((results) => {
        console.log(results);
        if(results !== null)  {
            results.songs.forEach((result) => {
                const songCard = document.createElement("div");
                songCard.className = "song-card";
                songCard.setAttribute("audio_path", result.audio_path);
                songCard.innerHTML = `
                    <img 
                        src='/assets/img/song-default.png'
                        alt=''
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
            songPlayUpdate(audio);
        } else {
            console.log('fetch')
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

function getCreatorIds() {
    const songContainer = document.getElementById("songs-container");
    const userId = songContainer.getAttribute("user_id");
    getSongsList(userId).then((results) => {
        const creatorIds = [];
        results.songs.forEach((result) => {
            creatorIds.push(result.user_id);
        });
        return creatorIds;
    });
}

function songPlayUpdate(audio) {
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
            audio.pause();
            audio.setAttribute("src", songCard.getAttribute("audio_path"));
            audio.play();
        })
    }
}