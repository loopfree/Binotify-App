/**
 * <div class="song">
        <div class="grid-container">
            <div class="number">1</div>
            <button class="play-button">
                <i class="fas fa-play"></i>
            </button>
            <div class="image">
                <div class="image-container">
                    <img
                        src="/assets/img/auth-img/feel_special.jpg"
                        alt="song-image"
                    />
                </div>
            </div>
            <div class="judul">Feel Special</div>
            <div class="penyanyi">TWICE</div>
            <div class="blank"></div>
            <div class="genre">idk the genre</div>
            <div class="tahun">2019</div>
        </div>
    </div>
 */
// est");

let pageNum = 0;

const searchInput = document.getElementById("search-input");
const songList = document.getElementsByClassName("song-list")[0];

const debounce = (cb, time) => {
    let timeoutId = null;
    const func = () => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(cb,time);
    }

    return func;
}

songList.innerHTML = "";

const getNewSong = debounce(() => {
    const xhr = new XMLHttpRequest();

    xhr.onloadend = function() {
        try {
            const resp = JSON.parse(this.responseText);

            console.log(resp);

            if(!resp.succeed) {
                throw "Failed to obtain song";
            }

            const songResult = resp.songResult;

            songList.innerHTML = "";

            for(let i = 0; i < songResult.length; ++i) {
                const outerDiv = document.createElement("div");
                outerDiv.className = "song";

                outerDiv.onclick = () => {
                    const redirectForm = document.createElement("form");

                    redirectForm.action = "/server/detail-lagu/index.php";
                    redirectForm.method = "GET";

                    const songId = document.createElement("input");
                    songId.type = "hidden";
                    songId.value = songResult[i].songId;
                    songId.name = "song-id";

                    redirectForm.appendChild(songId);

                    document.body.appendChild(redirectForm);

                    redirectForm.submit();
                }

                const innerDiv = document.createElement("div");
                innerDiv.className = "grid-container";

                outerDiv.appendChild(innerDiv);

                const songNum = document.createElement("div");     
                songNum.className = "number";
                
                songNum.innerText = "" + (i + 1);

                innerDiv.appendChild(songNum);

                const playBtn = document.createElement("button");
                playBtn.className = "play-button";

                playBtn.onclick = () => {

                    const redirectForm = document.createElement("form");

                    redirectForm.action = "/server/detail-lagu/index.php";
                    redirectForm.method = "GET";

                    const songId = document.createElement("input");
                    songId.type = "hidden";
                    songId.value = songResult[i].songId;
                    songId.name = "song-id";

                    redirectForm.appendChild(songId);

                    const autoplay = document.createElement("input");
                    autoplay.type = "hidden";
                    autoplay.value = "true";
                    autoplay.name = "autoplay";

                    redirectForm.appendChild(autoplay);

                    document.body.appendChild(redirectForm);

                    redirectForm.submit();
                }

                innerDiv.appendChild(playBtn);

                const iBtn = document.createElement("i");
                iBtn.className = "fas fa-play";
                
                playBtn.appendChild(iBtn);

                const outerImage = document.createElement("div");
                outerImage.className = "image";
                
                innerDiv.appendChild(outerImage);

                const innerImage = document.createElement("div");
                innerImage.className = "image-container";

                outerImage.appendChild(innerImage);

                const image = document.createElement("img");
                
                image.src = songResult[i].imagePath;
                image.alt = "song-image";

                innerImage.appendChild(image);

                const judulDiv = document.createElement("div");

                judulDiv.className = "judul";
                judulDiv.innerText = songResult[i].judul;

                innerDiv.appendChild(judulDiv);

                const penyanyiDiv = document.createElement("div");
                penyanyiDiv.className = "penyanyi";

                if("penyanyi" in songResult[i]) {
                    penyanyiDiv.innerText = songResult[i].penyanyi;
                } else {
                    penyanyiDiv.innerText = "None";
                }

                innerDiv.appendChild(penyanyiDiv);

                const blankDiv = document.createElement("div");

                blankDiv.className = "blank";

                innerDiv.appendChild(blankDiv);

                const genreDiv = document.createElement("div");

                genreDiv.className = "genre";
                genreDiv.innerText = songResult[i].genre;

                innerDiv.appendChild(genreDiv);

                const tahunDiv = document.createElement("div");

                tahunDiv.className = "tahun";
                tahunDiv.innerText = songResult[i].tahunTerbit;

                innerDiv.appendChild(tahunDiv);

                songList.appendChild(outerDiv);
            }
        } catch(e) {
            console.log(this.responseText);
            console.log(e);
        }
    }

    const genreFilter = [];

    const genreCheckboxes = document.getElementsByClassName("filter-checkbox");

    for(let i = 0; i < genreCheckboxes.length; ++i) {
        if(genreCheckboxes[i].checked) {
            genreFilter.push(genreCheckboxes[i].value);
        }
    }

    const isReversed = document.getElementById("reverse-checkbox");

    const query = {
        searchQuery: searchInput.value,
        pageNum: pageNum,
        genreFilter: genreFilter,
        reversed: isReversed.checked
    }

    const qJson = JSON.stringify(query);

    console.log(qJson);

    xhr.open("GET", `/server/search_sort_filter/ajax.php?query=${qJson}`);

    xhr.send();
}, 500);

getNewSong();

searchInput.onkeydown = () => {
    pageNum = 0;
    getNewSong();
}

const searchSubmit = document.getElementById("search-submit");

searchSubmit.onclick = () => {
    getNewSong();
}

const sortBtn = document.getElementsByClassName("sort-button")[0];

const sortChkbox = document.getElementById("reverse-checkbox");

sortBtn.onclick = () => {
    sortChkbox.checked = !sortChkbox.checked;
    getNewSong();
}