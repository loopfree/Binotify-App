const albumContainer = document.getElementById("album-container");

window.onload = () => {
    const xhr = new XMLHttpRequest();

    xhr.open("GET", "/server/album-list/index.php", true);
    xhr.onload = function() {
        albumContainer.innerHTML = this.responseText;
        albumPlayUpdate();
    }
    
    xhr.send(null);
}

function albumPlayUpdate() {
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
    }
}