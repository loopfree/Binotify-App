window.onload = () => {
    const userId = window.localStorage.getItem("user-id");
    if(userId === null) {
        window.location.href = "/page/login";
    }

    // const addition = "";

    // if(userId !== null) {
    //     addition = `?user-id=${userId}`;
    // }
    
    // NAV
    const nav = document.getElementsByClassName('nav')[0];
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/server/nav/nav.php?user-id=${userId || null}`);
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