window.onload = () => {
    const nav = document.getElementsByClassName('nav')[0];
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/server/nav/nav.php`);
    xhr.onload = function() {
        nav.innerHTML = this.responseText;
    }
    xhr.send();
}

const windowLocationTemp = window.location.href.split("?");

if(windowLocationTemp.length == 2) {
    const retMsg = windowLocationTemp[1];

    alert(retMsg);
}

const judul = document.getElementById("Judul");
const penyanyi = document.getElementById("Penyanyi");
const tanggalTerbit = document.getElementById("Tanggal_terbit");
const genre = document.getElementById("Genre");
const audio = document.getElementById("Audio");
const image = document.getElementById("Image");
const duration = document.getElementById("Duration");
const album = document.getElementById("Album")

audio.onchange = () => {
    const fileReader = new FileReader();

    fileReader.onload = () => {
        const temp = document.createElement("audio");

        temp.src = fileReader.result;

        temp.onloadedmetadata = () => {
            duration.value = temp.duration;
        }
    }

    fileReader.readAsDataURL(audio.files[0]);
}