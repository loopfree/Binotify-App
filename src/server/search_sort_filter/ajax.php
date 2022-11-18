<?php

$query = $_GET["query"];

$json = json_decode($query, true);

$searchQuery = $json["searchQuery"];
$pageNumber = $json["pageNum"];
$genreFilter = $json["genreFilter"];
$reversed = $json["reversed"];
$dateSorted = $json["dateSorted"];

$offset = $pageNumber * 7;

$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

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
            LOWER(judul) LIKE LOWER('$searchQuery%')
            OR
            LOWER(penyanyi) LIKE LOWER('$searchQuery%')
        ORDER BY
            judul ASC
        LIMIT 7 OFFSET $offset;
    ";
} else {
    $filterStr = "(";
    for($i = 0; $i < count($genreFilter) - 1; ++$i) {
        $filterStr .= "'" . $genreFilter[$i] . "',";
    }

    $filterStr .= "'" . $genreFilter[$i] . "')";

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
            LOWER(judul) LIKE LOWER('$1%')
            OR
            LOWER(penyanyi) LIKE LOWER('$1%')
            AND
            genre IN $2
        ORDER BY
            judul ASC
        LIMIT 7 OFFSET $3;  
    ";
}

if($dateSorted) {
    $sqlQuery = str_replace("judul ASC", "tanggal_terbit DESC, judul ASC", $sqlQuery);
}

if($reversed) {
    $sqlQuery = str_replace("ASC", "DESC", $sqlQuery);
}


$result = pg_query_params($conn, $sqlQuery, [$searchQuery, $filterStr, $offset]);

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