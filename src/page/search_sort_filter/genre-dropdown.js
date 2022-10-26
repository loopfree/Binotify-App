const genreList = document.getElementsByClassName("genre-list")[0];

const xhr = new XMLHttpRequest();

xhr.onloadend = function() {
    const json = JSON.parse(this.responseText);

    genreList.innerHTML = "";

    for(const genre of json) {
        const genreDiv = document.createElement("div");

        genreDiv.className = "song-genre";
        genreDiv.innerText = genre;

        const genreInput = document.createElement("checkbox");

        genreInput.className = "filter-checkbox";
        genreInput.style = "display: none";
        genreInput.value = genre;

        genreList.appendChild(genreInput);
        
        genreDiv.onclick = () => {
            if(genreInput.checked) {
                genreDiv.style = "";
                genreInput.checked = false;
            } else {
                genreDiv.style = "background-color: #0F0";
                genreInput.checked = true;
            }
        }

        genreList.appendChild(genreDiv);
    }
}

xhr.open("GET", "/server/search_sort_filter/get_genre.php");

xhr.send();