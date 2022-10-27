window.onload = () => {
    const userId = window.localStorage.getItem("user-id");

    let addition = "";

    if(userId !== null) {
        addition = `?user-id=${userId}`;
    }

    const nav = document.getElementsByClassName('nav')[0];
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/server/nav/nav.php${addition}`);
    xhr.onload = function() {
        nav.innerHTML = this.responseText;
    }
    xhr.send();
}