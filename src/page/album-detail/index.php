<?php
session_start();
if (!isset($_GET["album-id"])) {
    header("Location: /page/album-list/");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>\(OwO)/</title>
    <link rel="stylesheet" href="album-detail.css">
    <script src="album-detail.js" defer></script>
</head>
<body class="dark-bg body">
    <nav class="nav"></nav>
    <main album-id=<?php echo $_GET["album-id"]; ?>>
        <div class="album-info-grid">
            <div class="album-image-container">
                <img src=""/>
            </div>
            <div class="album-tag">
                <p>ALBUM</p>
            </div>
            <div class="album-title">
                <h1>Album Title</h1>
            </div>
            <div class="album-desc">
                <p>Album Description</p>
            </div>
            
            <?php
            if($_SESSION["admin"]) {
                ?>
                <div class="album-settings">
                    <div class="edit-settings">
                        <li class="settings-button">
                            <lord-icon
                                src="/assets/lord-icon/settings-icon.json"
                                trigger="hover"
                                colors="primary:#ffffff"
                                style="width:2rem;height:2rem">
                            </lord-icon>
                        </li>
                        <form class="form" action="/server/album-detail/edit-album.php" method="POST" enctype="multipart/form-data"> 
                            <div id="edit-modal" class="modal">
                                <div class="modal-content">
                                    <div class="close-area">
                                        <span class="close">&times;</span>
                                    </div>
                                    <p class="album-title-edit">Album Title</p>
                                    <div class="album-title-new">
                                        <input type="text" name="album-title">
                                    </div>
                                    <p class="album-cover-edit">Album Cover</p>
                                    <div class="album-cover-new">
                                        <input type="file" name="album-image" accept="image/*">
                                    </div>
                                    <p class="genre-edit">Genre</p>
                                    <div class="genre-new">
                                        <input type="text" name="genre">
                                    </div>
                                    <input hidden type="text" name="album-id" value="<?php echo $_GET["album-id"]; ?>">
                                    <div class="save-changes">
                                        <button>Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="delete-settings">
                        <li class="settings-button">
                            <lord-icon
                                src="/assets/lord-icon/delete-icon.json"
                                trigger="hover"
                                colors="primary:#ffffff"
                                style="width:2rem;height:2rem">
                            </lord-icon>
                        </li>
                        <div id="delete-modal" class="modal">
                            <div class="modal-content">
                                <p class="delete-sentence">Do you want to delete the album?</p>
                                <div id="delete-confirm-container">
                                    <button class="confirm-button">Confirm</button>
                                </div>
                                <div id="delete-cancel-container">
                                    <button class="cancel-button">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php
            }
            ?>
        </div>

        <div class="cont">
            <div class="song-list"></div>
        </div>
       
    </main>
    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
</body>
</html>