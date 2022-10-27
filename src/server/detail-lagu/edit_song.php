<?php

// $json_content = file_get_contents("php://input");

// $decoded = json_decode($json_content, true);

require $_SERVER['DOCUMENT_ROOT'] . '/hash.php';

function separateNameAndExt($filename) {
    $result = array();
    $ext = "";
    $name = "";
    $extensionIndex = 0;

    for($i = strlen($filename) - 1; $i >= 0; --$i) {
        if($filename[$i] === '.') {
            $extensionIndex = $i;
            break;
        }
    }

    for($i = 0; $i < strlen($filename); ++$i) {
        if($i == $extensionIndex) {
            continue;
        } else if($i > $extensionIndex) {
            $ext .= $filename[$i];
        } else {
            $name .= $filename[$i];
        }
    }
    
    $result += ["ext" => $ext];
    $result += ["name" => $name];
    
    return $result;
}

$songId = $_POST["songId"];
$judul = $_POST["Judul"];
$album = $_POST["Album"];
$tanggalTerbit = $_POST["Tanggal_terbit"];
$genre = $_POST["Genre"];
$albumId = null;

$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

if($album !== "") {
    $query = "
        SELECT
            album_id
        FROM
            \"Album\"
        WHERE
            judul = '$album';
    ";

    $result = pg_query($conn, $query);

    $row = pg_fetch_row($result);

    if($row === false) {
        header("Location: /page/detail-lagu/index.php?song-id=$songId&message=Album-doesn't-exist");
        return;
    }

    $albumId = $row[0];

    $query = "
        UPDATE
            \"Song\"
        SET
            album_id = $albumId
        WHERE
            song_id = $songId;
    ";

    $result = pg_query($conn, $query);

    if($result === false) {
        header("Location: /page/detail-lagu/index.php?song-id=$songId&message=Error-update-album");
        return;
    }
}

if($judul !== "") {
    $query = "
        UPDATE 
            \"Song\"
        SET 
            judul = '$judul'
        WHERE
            song_id = $songId; 
    ";

    $result = pg_query($conn, $query);

    if($result === false) {
        header("Location: /page/detail-lagu/index.php?song-id=$songId&message=Error-update-judul");
        return;
    }
}

if($tanggalTerbit !== "") {
    $query = "
        UPDATE
            \"Song\"
        SET
            tanggal_terbit = '$tanggalTerbit'
        WHERE
            song_id = $songId;
    ";

    $result = pg_query($conn, $query);

    if($result === false) {
        header("Location: /page/detail=lagu/index.php?song-id=$songId&message=Error-update-tanggal-terbit");
        return;
    }
}

if($genre !== "") {
    $query = "
        UPDATE
            \"Song\"
        SET
            genre = '$genre'
        WHERE
            song_id = $songId;
    ";

    $result = pg_query($conn, $query);

    if($result === false) {
        header("Location: /page-detail-lagu/index.php?song-id=$songId&message=Error-update-genre");
        return;
    }
}

$currentTime = (string) time();

if(isset($_FILES["Audio"]) && $_FILES["Audio"]["error"] != 4) {
    $musicDir = '/../assets/audio/';

    $musicName = basename($_FILES["Audio"]["name"]);
    $musicName = separateNameAndExt($musicName);

    $musicNameHashed = $musicName["name"] . $currentTime;
    $musicNameFixed = $musicNameHashed . '.' . $musicName['ext'];

    $musicFile = realpath(dirname(getcwd())) . $musicDir . $musicNameFixed;

    $sqlMusicFile = '/assets/audio/' . $musicNameFixed;

    $message = "";

    if(!move_uploaded_file($_FILES['Audio']['tmp_name'], $musicFile)) {
        header("Location: /page/detail-lagu/index.php?song-id=$songId&message=Error-upload-lagu");
        return;
    }

    $query = "
        UPDATE
            \"Song\"
        SET
            audio_path = '$sqlMusicFile'
        WHERE
            song_id = $songId;
    ";

    $result = pg_query($conn, $query);

    if($result === false) {
        header("Location: /page/detail-lagu/index.php?song-id=$songId&message=Error-update-lagu");
        return;
    }
}

if(isset($_FILES["Image"]) && $_FILES["Image"]["error"] != 4) {
    $imageDir = '/../assets/img/';

    $imageName = basename($_FILES['Image']['name']);
    $imageName = separateNameAndExt($imageName);

    $imageNameHashed = $imageName['name'] . $currentTime;
    $imageNameFixed = $imageNameHashed . '.' . $imageName['ext'];

    $imageFile = realpath(dirname(getcwd())) . $imageDir . $imageNameFixed;
    $sqlImageFile = "/assets/img/" . $imageNameFixed;

    if(!move_uploaded_file($_FILES['Image']['tmp_name'], $imageFile)) {
        header("Location: /page/detail-lagu/index.php?song-id=$songId&message=error-upload-image");
    }

    $query = "
        UPDATE
            \"Song\"
        SET
            audio_path = '$sqlMusicFile'
        WHERE
            song_id = $songId;
    ";

    $result = pg_query($conn, $query);

    if($result === false) {
        header("Location: /page/detail-lagu/index.php?song-id=$songId&message=Error-update-image");
        return;
    }
}

pg_close($conn);

header("Location: /page/detail-lagu/index.php?song-id=$songId");
?>