<?php

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

if($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /index.php");
    return;
}

$currentTime = (string) time();

$musicDir = '/../assets/audio/';

$musicName = basename($_FILES["Audio"]["name"]);
$musicName = separateNameAndExt($musicName);

$musicNameHashed = $musicName["name"] . $currentTime;
$musicNameFixed = $musicNameHashed . '.' . $musicName['ext'];

$musicFile = realpath(dirname(getcwd())) . $musicDir . $musicNameFixed;

$sqlMusicFile = '/assets/audio/' . $musicNameFixed;

$message = "";

if(!move_uploaded_file($_FILES['Audio']['tmp_name'], $musicFile)) {
    $message .= "Upload audio Error";
}

$sqlImageFile = null;

if(isset($_FILES['Image']) && $_FILES['Image']['error'] !== 4) {
    $imageDir = '/../assets/img/';

    $imageName = basename($_FILES['Image']['name']);
    $imageName = separateNameAndExt($imageName);

    $imageNameHashed = $imageName['name'] . $currentTime;
    $imageNameFixed = $imageNameHashed . '.' . $imageName['ext'];

    $imageFile = realpath(dirname(getcwd())) . $imageDir . $imageNameFixed;
    $sqlImageFile = "/assets/img/" . $imageNameFixed;

    if(!move_uploaded_file($_FILES['Image']['tmp_name'], $imageFile)) {
        $message .= "Upload image error";
    }
}

$judul = $_POST["Judul"];
$penyanyi = $_POST["Penyanyi"];
$tanggalTerbit = $_POST["Tanggal_terbit"];
$genre = $_POST["Genre"];
$duration = $_POST["Duration"];
$album = $_POST["Album"];

$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

$albumId = null;

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
        $message .= "There is no album";
        header("Location: /page/add-song/index.html?$message");
        return;
    } else {
        $albumId = $row[0];
    }
}

$songId = hashUsername($judul);

// print_r($songId);
// print_r('judul: '$judul);
// print_r('penyanyi: '$penyanyi);
// print_r('tanggal terbit:' $tanggalTerbit);
// print_r($genre);
// print_r($duration);
// print_r($sqlMusicFile);
// print_r($sqlImageFile);
// print_r($albumId);

if($albumId !== null) {
    $query = "
        INSERT INTO
            \"Song\"
        VALUES (
            $songId,
            '$judul',
            '$penyanyi',
            '$tanggalTerbit',
            '$genre',
            $duration,
            '$sqlMusicFile',
            '$sqlImageFile',
            $albumId
        );
    ";
} else {
    $query = "
        INSERT INTO
            \"Song\"
        VALUES (
            $songId,
            '$judul',
            '$penyanyi',
            '$tanggalTerbit',
            '$genre',
            $duration,
            '$sqlMusicFile',
            '$sqlImageFile'
        );
    ";
}

$result = pg_query($conn, $query);
pg_close($conn);

header("Refresh:0; url=/page/album-list/");
?>