<?php

$query = $_GET["query"];

$json = json_decode($query, true);

$searchQuery = $json["searchQuery"];
$pageNumber = $json["pageNum"];
$genreFilter = $json["genreFilter"];

$offset = $pageNumber;

$conn = pg_connect("host=localhost port=5432 dbname=tubesIF3110 user=postgres password=admin");

$sqlQuery;

if(count($genreFilter) === 0) {
    $sqlQuery = "
        SELECT
            song_id,
            judul,
            penyanyi,
            genre,
            DATE_PART('year',tanggal_terbit) AS tahun_terbit,
            image_path
        FROM
            \"Song\"
        WHERE
            judul LIKE '$searchQuery%'
        ORDER BY
            judul ASC
        LIMIT 10 OFFSET $offset;
    ";
} else {
    $filterStr = "(";
    for($i = 0; $i < count($genreFilter) - 1; ++$i) {
        $filterStr .= $genreFilter[$i] . ",";
    }

    $filterStr .= $genreFilter[$i] . ")";

    $sqlQuery = "
            SELECT
            song_id,
            judul,
            penyanyi,
            genre,
            DATE_PART('year',tanggal_terbit) AS tahun_terbit,
            image_path
        FROM
            \"Song\"
        WHERE
            judul LIKE '$searchQuery%'
            AND
            genre IN
        " . $filterStr . "
        ORDER BY
            judul ASC
        LIMIT 10 OFFSET $offset  
    ";
}

$result = pg_query($conn, $sqlQuery);

if($result === false) {
    echo pg_last_error($conn);
    return;
}

$res = array();

$res += ["succeed" => true];
$res += ["songResult" => array()];

$index = 0;

while($row = pg_fetch_row($result)) {
    $temp = array();
    $temp += ["songId" => $row[0]];
    $temp += ["judul" => trim($row[1])];
    $temp += ["penyanyi" => trim($row[2])];
    $temp += ["genre" => trim($row[3])];
    $temp += ["tahunTerbit" => $row[4]];
    $temp += ["imagePath" => trim($row[5])];

    $res["songResult"] += [$index => $temp];
    $index += 1;
}

// print_r($res);

echo json_encode($res);

pg_close($conn);

?>