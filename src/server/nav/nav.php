<?php
session_start();
?>
<h1 class="title app-title">\(OwO)/</h1>
<ul class="nav-container">
    <a href="/page/home/">
        <li class="nav-button">
            <lord-icon
                src="/assets/lord-icon/home-icon.json"
                trigger="hover"
                colors="primary:#ffffff"
                style="width:2rem;height:2rem">
            </lord-icon>
            <p class="nav-desc">Home</p>
        </li>
    </a>
    <a href="/page/search_sort_filter/">
        <li class="nav-button">
            <lord-icon
                src="/assets/lord-icon/search-icon.json"
                trigger="hover"
                colors="primary:#ffffff"
                style="width:2rem;height:2rem">
            </lord-icon>
            <p class="nav-desc">Search</p>
        </li>
    </a>
    <a href="/page/album-list/">
        <li class="nav-button">
            <lord-icon
                src="/assets/lord-icon/album-icon.json"
                trigger="hover"
                colors="primary:#ffffff"
                style="width:2rem;height:2rem">
            </lord-icon>
            <p class="nav-desc">Albums</p>
        </li>
    </a>
    <?php
    if($_SESSION["logged_in"]) {
        ?>
        <a href="/page/singer-list/index.php">
            <li class="nav-button">
                <script src="https://cdn.lordicon.com/fudrjiwc.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/kipaqhoz.json"
                    trigger="morph"
                    colors="primary:#ffffff"
                    style="width:2rem;height:2rem">
                </lord-icon>
                <p class="nav-desc">Premium singers</p>
            </li>
        </a>
        <?php
    }
    ?>
    <?php
    if ($_SESSION['logged_in'] && $_SESSION['admin']) {
        ?>
        <a href="/page/add-album/">
            <li class="nav-button">
                <lord-icon
                    src="/assets/lord-icon/add-album-icon.json"
                    trigger="hover"
                    colors="primary:#ffffff"
                    style="width:2rem;height:2rem">
                </lord-icon>
                <p class="nav-desc">Add Album</p>
            </li>
        </a>
        <a href="/page/add-song/">
            <li class="nav-button">
                <lord-icon
                    src="/assets/lord-icon/add-song-icon.json"
                    trigger="hover"
                    colors="primary:#ffffff"
                    style="width:2rem;height:2rem">
                </lord-icon>
                <p class="nav-desc">Add Song</p>
            </li>
        </a>
        <a href="/page/user-list/">
            <li class="nav-button">
                <lord-icon
                    src="/assets/lord-icon/user-list-icon.json"
                    trigger="hover"
                    colors="primary:#ffffff"
                    style="width:2rem;height:2rem">
                </lord-icon>
                <p class="nav-desc">User List</p>
            </li>
        </a>
        </ul>
        <div class="divider"></div>
        <?php
    }
    ?>
    <?php
    if(isset($_SESSION['logged_in'])) {
        ?>
        <div class="nav-button logout-button" onclick="
            const logoutButton = document.getElementsByClassName('nav-button logout-button')[0];
            logoutButton.onclick = function() {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `/server/utils/logout.php`);
                xhr.onload = function() {
                    window.location.href = '/page/login/';
                }
                xhr.send();
            }"
        >
            <lord-icon
                src="/assets/lord-icon/logout-icon.json"
                trigger="hover"
                colors="primary:#f037a5"
                style="width:2rem;height:2rem">
            </lord-icon>
            <p class="nav-desc">Log Out</p>
        </div>
        <?php
    } else {
        ?>
        <div class="nav-button logout-button" onclick="
            window.location.href ='/index.php';
            "
        >
            <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/rivoakkk.json"
                trigger="hover"
                colors="primary:#f037a5"
                style="width:2rem;height:2rem">
            </lord-icon>
            <p class="nav-desc">Log In</p>
        </div>
        <?php
    }
    ?>