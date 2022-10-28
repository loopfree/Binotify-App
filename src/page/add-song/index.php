<?php
    session_start();
    if (!($_SESSION["logged_in"] && $_SESSION["admin"])) {
        header("Location: /page/home/");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>\(OwO)/</title>
    <link rel="stylesheet" href="add-song.css">
    <script src="add-song.js" defer></script>
</head>
<body class="body dark-bg">
    <nav class="nav"></nav>
    <main>
        <h1 class="title">Add Song</h1>
        <form class="form" action="/server/add-song/index.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label for="Judul">Title</label>
                <input type="text" id="Judul" name="Judul" placeholder="Shape of You" maxlength="64" required>
            </div>
            <div class="input-group">
                <label for="Album">Artist</label>
                <input type="text" id="Penyanyi" name="Penyanyi" placeholder="Ed Sheeran" maxlength="128">
            </div>
            <div class="input-group">
                <label for="Tanggal_terbit">Release date</label>
                <input type="date" id="Tanggal_terbit" name="Tanggal_terbit" placeholder="2020-01-01" required>
            </div>
            <div class="input-group">
                <label for="Genre">Genre</label>
                <input type="text" id="Genre" name="Genre" placeholder="Pop" maxlength="64">
            </div>
            <div class="input-group">
                <label for="Audio">Audio</label>
                <input type="file" id="Audio" name="Audio" accept="audio/*" required>
            </div>
            <input type="hidden" id="Duration" name="Duration"/>
            <div class="input-group">
                <label for="Image">Cover Image</label>
                <input type="file" id="Image" name="Image" accept="image/*">
            </div>
            <div class="input-group">
                <label for="Album">Album</label>
                <input type="text" id="Album" name="Album" placeholder="Divide" maxlength="128">
            </div>
            <button type="submit" class="btn save-btn">Save</button>
        </form>
    </main>
    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
</body>
</html>