const songContainer = document.getElementById("songs-container");
console.log(songContainer.style.display);

window.onload = () => {
    const xhr = new XMLHttpRequest();

    xhr.open("GET", "/server/home/index.php", true);
    xhr.onload = function() {
        songContainer.innerHTML = this.responseText;
        songPlayUpdate();
    }
    
    xhr.send(null);
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