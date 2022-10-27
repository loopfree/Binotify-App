<?php

session_start();

$songId = null;

$audioPath = null;
$imagePath = null;

$judul;
$penyanyi;
$tanggalTerbit;
$genre;
$albumId;
$albumName = "";

if(isset($_GET["song-id"])) {
    $songId = $_GET["song-id"];

    $conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

    $query = "
        SELECT
            audio_path,
            image_path,
            judul,
            penyanyi,
            tanggal_terbit,
            genre,
            album_id
        FROM
            \"Song\"
        WHERE
            song_id = $songId;
    ";

    $result = pg_query($conn, $query);

    $row = pg_fetch_row($result);

    if($row !== false) {
        $audioPath = trim($row[0]);
        $imagePath = trim($row[1]);
        $judul = trim($row[2]);
        $penyanyi = trim($row[3]);
        $tanggalTerbit = trim($row[4]);
        $genre = trim($row[5]);
        $albumId = $row[6];

        if($row[6] !== null) {
            $query = "
                SELECT
                    judul
                FROM
                    \"Album\"
                WHERE
                    album_id = $row[6];
            ";

            $result = pg_query($conn, $query);

            $row = pg_fetch_row($result);

            $albumName = $row[0];
        }
    }

    pg_close($conn);
}

if(isset($_GET["message"])) {
    ?>
    <script>
        alert("<?php echo $_GET['message'] ?>");
    </script>
    <?php
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>\(OwO)/</title>
    <link rel="stylesheet" href="detail-lagu.css">
    <script src="modal.js" defer></script>
    <script src="edit-lagu.js" defer></script>
</head>
<body class="dark-bg home-body">
    <nav class="nav"></nav>
    <main>
        <div class="container-grid">
            <div class="head">
                Song Detail
            </div>
            <script>
                const songId = <?php echo $songId ?>
            </script>
            <?php
            (function() use($songId) {
                if($_SESSION["is-admin"]) {
                    ?>

                    <div class="edit">
                        <div class="edit-del-blank"></div>

                        <button class="edit-btn" id="edit-btn">
                            Edit
                        </button>

                        <div id="edit-modal" class="modal">
                            <div class="modal-content">
                                <div class="close-area">
                                    <span class="close">&times;</span>
                                </div>
                                <form action="/server/detail-lagu/edit_song.php" method="POST" enctype="multipart/form-data">

                                    <div class="cover-img-edit">
                                        Cover Image
                                    </div>
                                    <div class="cover-img-new">
                                        <input type="file" id="Image" name="Image" accept="image/*">
                                    </div>
                                    <input type="hidden" id="image-data">
    
                                    <div class="audio-edit">
                                        Audio
                                    </div>
                                    <div class="audio-new">
                                        <input type="file" id="Audio" name="Audio" accept="audio/*">
                                    </div>
                                    <input type="hidden" name="songId" value="<?php echo $songId ?>" />
    
                                    <div class="album-edit">
                                        Album
                                    </div>
                                    <div class="album-new">
                                        <input type="text" id="album-new" name="Album" >
                                    </div>
    
                                    <div class="judul-edit">
                                        Judul
                                    </div>
                                    <div class="judul-new">
                                        <input type="text" id="judul-new" name="Judul" >
                                    </div>
    
                                    <!-- <div class="penyanyi-edit">
                                        Penyanyi
                                    </div>
                                    <div class="penyanyi-new">
                                        <input type="text">
                                    </div> -->
    
                                    <div class="tgl-edit">
                                        Tanggal Terbit
                                    </div>
                                    <div class="tgl-new">
                                        <input type="date" id="Tanggal_terbit" name="Tanggal_terbit" placeholder="2020-01-01">
                                    </div>
    
                                    <div class="genre-edit">
                                        Genre
                                    </div>
                                    <div class="genre-new">
                                        <input type="text" id="genre-new" name="Genre">
                                    </div>
    
                                    <div class="save-changes">
                                        <button>Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <button class="del-btn" id="del-btn">
                            Delete
                        </button>
                        
                        <div id="delete-modal" class="modal">
                            <div class="modal-content">
                                <div class="close-area">
                                    <!-- <span class="close">&times;</span> -->
                                </div>
                                <p class="delete-sentence">Do you want to delete this song permanently?</p>
                            <form action="/server/detail-lagu/delete_song.php" method="POST">
                                <input type="hidden" name="song-id" value="<?php echo $songId ?>">
                                <div id="delete-confirm-container">
                                    <button>Confirm</button>
                                </div>
                            </form>
                            <div id="delete-cancel-container">
                                <button class="close">Cancel</button>
                            </div>
                        </div>
                    </div>

                    </div>
                    <?php
                }
            })();
            ?>
            <div class="song-image">
                <img src="<?php echo $imagePath ?>" alt="no-image"/>
            </div>
            <div class="duration">
                <audio controls id="audio-player">
                    <source src="<?php echo $audioPath ?>" type="audio/mp3">
                  Your browser does not support the audio element.
                </audio>
            </div>
            <?php
                if(isset($_GET["autoplay"])) {
                    ?>
                        <script>
                            const audioPlayer = document.getElementById("audio-player");

                            document.onload = () => {
                                audioPlayer.currentTime = 0;
                                audioPlayer.play();
                            }
                            </script>
                    <?php
                }
            ?>
            <?php
            if($albumName !== "") {
                ?>
                <div class="album">
                    <a 
                        href="/page/album-detail/index.php?album-id=<?php echo $albumId ?>"
                    >
                        <?php echo $albumName ?>
                    </a>
                </div>
                <style>
                    .album > a {
                        all: unset;
                        font-family: "Gotham Bold";
                        padding: 10px;
                        background-color: #1ed760;
                        border: 1px solid #1ed760;
                        border-radius: 5px;
                    }

                    .album > a:hover {
                        border: 1px solid #f037a5;
                        background-color: transparent;
                        color: #f037a5;
                    }
                </style>
                <?php
            } else {
                ?>
                <style>
                    .album > a  {
                        padding: 0;
                        border: 0px;
                    }
                </style>
                 <div class="album">
                    <a 
                        href="/page/album-detail/index.php?album-id=<?php echo $albumId ?>"
                    >
                    </a>
                </div>
                <?php
            }
            ?>
            <div class="judul-lagu">
                <?php echo $judul ?>
            </div>
            <div class="penyanyi">
                <?php echo $penyanyi ?>
            </div>
            <div class="tanggal-terbit">    
                <?php echo $tanggalTerbit ?>
            </div>
            <div class="genre">
                <?php echo $genre ?>
            </div>
        </div>
    </main>
    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
</body>
</html>