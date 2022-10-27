<?php
(function(){
    if($_SERVER["REQUEST_METHOD"] !== "POST") {
        return;
    }

    // require '/hash.php';

    $json_content = file_get_contents("php://input");

    $decoded = json_decode($json_content, true);

    $judul = $decoded["Judul"];
    $penyanyi = $decoded["Penyanyi"];
    $tanggal_terbit = $decoded["Tanggal_terbit"];
    $genre = $decoded["Genre"];
    $duration = $decoded["Duration"];
    $audio = $decoded["Audio"];
    $image = $decoded["Image"];
    $album = $decoded["Album"];

    $conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

    $query = "
        INSERT INTO
            \"Lagu\"
        VALUES (
            '$judul',
            '$penyanyi',
            '$tanggal_terbit',
            '$genre',
            '$duration',
            '$audio',
            '$image',
            '$album'
        );
    ";

    $reuslt = pg_query($conn, $query);

    if(!$result) {
        echo "fail";
    } else {
        echo "succeed";
    }

    pg_close($conn);
})();
?>