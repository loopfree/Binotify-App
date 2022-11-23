<?php

require $_SERVER['DOCUMENT_ROOT'] . '/hash.php';
require $_SERVER['DOCUMENT_ROOT'] . '/postgreurl.php';

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

$sqlImageFile = '/assets/img/song-default.png';

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

$conn = pg_connect($postgreUrl);
$result = pg_query_params($conn, "SELECT * FROM \"Album\" WHERE Judul=$1", [$judul]);

if (pg_num_rows($result) > 0) {
    echo "<script type='text/javascript'>alert('Album name existed');
          window.location.href='/page/add-album/'</script>";
}
else {
    $albumId = hashUsername($judul);
    $query = "INSERT INTO \"Album\" VALUES ($1,$2,$3,$4,$5,$6,$7);";

    pg_query_params($conn, $query, [$albumId, $judul, $penyanyi, 0, $sqlImageFile, $tanggalTerbit, $genre]);
    pg_close($conn);
    header("Refresh:0; url=/page/album-list/");
}
?>