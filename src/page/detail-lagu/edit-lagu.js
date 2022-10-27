const saveChange = document.getElementsByClassName("save-changes")[0].getElementsByTagName("button")[0];

const imageData = document.getElementById("image-data");
const audioData = document.getElementById("audio-data");
const durationData = document.getElementById("duration-data");

const imageUpload = document.getElementById("Image");
const audioUpload = document.getElementById("Audio");

imageUpload.onchange = () => {
    const fileReader = new FileReader();

    fileReader.onload = () => {
        imageData.value = fileReader.result;
    }
}

audioUpload.onchange = () => {
    const fileReader = new FileReader();

    fileReader.onload = () => {
        audioData.value = fileReader.result;
    }
}

const judul = document.getElementById("judul-new");
const album = document.getElementById("album-new");
const date = document.getElementById("Tanggal_terbit");
const genre = document.getElementById("genre-new");

saveChange.onclick = () => {
    const req = {
        songId: songId,
        judul: judul.value,
        album: album.value,
        tanggalTerbit: date,
        genre: genre,
        newSong: audioData,
        newImage: imageData 
    }

    const reqStr = JSON.stringify(req);

    const xhr = new XMLHttpRequest();

    xhr.open("POST", "/server/detail-lagu/edit_song.php");

    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.send(reqStr);
}