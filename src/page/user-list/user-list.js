window.onload = () => {
    const nav = document.getElementsByClassName('nav')[0];
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/server/nav/nav.php');
    xhr.onload = function() {
        nav.innerHTML = this.responseText;
    }
    xhr.send();
}