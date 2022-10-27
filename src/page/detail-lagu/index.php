<?php

session_start();

$songId = null;

$audioPath = null;
$imagePath = null;

if(isset($_GET["song-id"])) {
    $songId = $_GET["song-id"];

    $conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

    $query = "
        SELECT
            audio_path,
            image_path
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
    }

    pg_close($conn);
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
            <div class="user">
                user
            </div>
            <div class="head">
                Song Detail
            </div>
            <script>
                const songId = <?php echo $songId ?>
            </script>
            <?php
            (function(){
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
                                    <input type="file" id="Audio" name="Audio" accept="audio/*" required>
                                </div>
                                <input type="hidden" id="audio-data" />
                                <input type="hidden" id="duration-data" />

                                <div class="album-edit">
                                    Album
                                </div>
                                <div class="album-new">
                                    <input type="text" id="album-new" >
                                </div>

                                <div class="judul-edit">
                                    Judul
                                </div>
                                <div class="judul-new">
                                    <input type="text" id="judul-new">
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
                                    <input type="date" id="Tanggal_terbit" name="Tanggal_terbit" placeholder="2020-01-01" required>
                                </div>

                                <div class="genre-edit">
                                    Genre
                                </div>
                                <div class="genre-new">
                                    <input type="text" id="genre-new">
                                </div>

                                <div class="save-changes">
                                    <button>Save Changes</button>
                                </div>
                            </div>
                        </div>

                        <button class="del-btn" id="del-btn">
                            Delete
                        </button>

                        <div id="delete-modal" class="modal">
                        <div class="modal-content">
                            <div class="close-area">
                                <span class="close">&times;</span>
                            </div>
                            <p class="delete-sentence">Do you want to delete the song?</p>
                            <div id="delete-confirm-container">
                                <button>Confirm</button>
                            </div>
                            <div id="delete-cancel-container">
                                <button>Cancel</button>
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
            <div class="album">
                <button>
                    Album
                </button>
            </div>
            <div class="judul-lagu">
                Feel Special
            </div>
            <div class="penyanyi">
                TWICE
            </div>
            <div class="tanggal-terbit">
                25 Oktober 2022
            </div>
            <div class="genre">
                genre
            </div>
        </div>
    </main>
    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
</body>
</html>