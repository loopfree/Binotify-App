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
$judul = trim($_POST["Judul"]);
$album = trim($_POST["Album"]);
$tanggalTerbit = trim($_POST["Tanggal_terbit"]);
$genre = trim($_POST["Genre"]);
$albumId = null;

$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

if($album !== "") {
    $query = "
        SELECT
            album_id, Penyanyi
        FROM
            \"Album\"
        WHERE
            judul = '$album';
    ";

    $result = pg_query($conn, $query);

    $row = pg_fetch_row($result);

    if($row === false) {
        echo "<script type='text/javascript'>alert('Album not found');
              window.location.href='/page/detail-lagu/index.php?song-id=$songId'</script>";
        return;
    }

    $albumId = $row[0];
    $penyanyiAlbum = trim($row[1]);

    $query = "UPDATE \"Song\" SET album_id = $1, Penyanyi = $2
              WHERE song_id = $3;";

    $result = pg_query_params($conn, $query, [$albumId, $penyanyiAlbum, $songId]);

    if($result === false) {
        echo "<script type='text/javascript'>alert('Update album error');
              window.location.href='/page/detail-lagu/index.php?song-id=$songId'</script>";
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
        echo "<script type='text/javascript'>alert('Update title error');
              window.location.href='/page/detail-lagu/index.php?song-id=$songId'</script>";
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
        echo "<script type='text/javascript'>alert('Update release date error');
              window.location.href='/page/detail-lagu/index.php?song-id=$songId'</script>";
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
        echo "<script type='text/javascript'>alert('Singer name does not match');
              window.location.href='/page/detail-lagu/index.php?song-id=$songId'</script>";
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
        echo "<script type='text/javascript'>alert('Upload audio error');
              window.location.href='/page/detail-lagu/index.php?song-id=$songId'</script>";
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
        echo "<script type='text/javascript'>alert('Update audio error');
              window.location.href='/page/detail-lagu/index.php?song-id=$songId'</script>";
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
        echo "<script type='text/javascript'>alert('Upload image error');
              window.location.href='/page/detail-lagu/index.php?song-id=$songId'</script>";
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
        echo "<script type='text/javascript'>alert('Update image error');
              window.location.href='/page/detail-lagu/index.php?song-id=$songId'</script>";
        return;
    }
}

pg_query_params($conn, "UPDATE \"Album\" SET Total_duration=(SELECT COALESCE(SUM(Duration),0) FROM \"Song\" WHERE album_id=$1) 
                                         WHERE album_id=$1", [$albumId]);

pg_close($conn);

header("Refresh:0; url=/page/detail-lagu/index.php?song-id=$songId");
?>