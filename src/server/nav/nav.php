<?php

$content = '
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
    <a href="/page/home/">
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
<a href="/page/home" class="nav-button logout-button">
    <lord-icon
        src="/assets/lord-icon/logout-icon.json"
        trigger="hover"
        colors="primary:#f037a5"
        style="width:2rem;height:2rem">
    </lord-icon>
    <p class="nav-desc">Log Out</p>
</a>
';

echo $content;
?>