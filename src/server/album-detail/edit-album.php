<?php
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/hash.php';
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';

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
$imagePath = null;

if(isset($_FILES['album-image']) && $_FILES['album-image']['error'] !== 4) {
    $imageDir = '/../assets/img/';

    $imageName = basename($_FILES['album-image']['name']);
    $imageName = separateNameAndExt($imageName);

    $imageNameHashed = $imageName['name'] . $currentTime;
    $imageNameFixed = $imageNameHashed . '.' . $imageName['ext'];

    $imageFile = realpath(dirname(getcwd())) . $imageDir . $imageNameFixed;
    $imagePath = "/assets/img/" . $imageNameFixed;

    if(!move_uploaded_file($_FILES['album-image']['tmp_name'], $imageFile)) {
        $message .= "Upload image error";
    }
}

$title = trim($_POST["album-title"]);
$genre = trim($_POST["genre"]);
$albumId = $_POST["album-id"];

if ($title) {
    pg_query_params($conn, "UPDATE \"Album\" SET Judul=$1 WHERE album_id=$2", [$title, $albumId]);
}

if ($imagePath) {
    pg_query_params($conn, "UPDATE \"Album\" SET Image_path=$1 WHERE album_id=$2", [$imagePath, $albumId]);
}

if ($genre) {
    pg_query_params($conn, "UPDATE \"Album\" SET Genre=$1 WHERE album_id=$2", [$genre, $albumId]);
}

header("Refresh: 0; url=/page/album-detail/index.php?album-id=$albumId");
?>