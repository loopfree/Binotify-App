window.onload = () => {
    // NAV
    const nav = document.getElementsByClassName('nav')[0];
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/server/nav/nav.php`);
    xhr.onload = function() {
        nav.innerHTML = this.responseText;
    }
    xhr.send();

    // USER LIST
    const userList = document.getElementById("user-table-body");
    const xhr2 = new XMLHttpRequest();
    xhr2.open("GET", "/server/user-list/index.php", true);
    xhr2.onload = function() {
        userList.innerHTML = this.responseText;
    }
    xhr2.send();
}