const userId = window.localStorage.getItem("user-id");

const xhr = new XMLHttpRequest();

xhr.onloadend = function() {
    if(this.responseText === "no") {
        const editDiv = document.getElementsByClassName("edit")[0]
        if(editDiv !== undefined) {
            editDiv.remove();
        }

        const delDiv = document.getElementsByClassName("del-btn")[0]
        if(delDiv !== undefined) {
            delDiv.remove();
        }
    } else if(this.responseText !== "yes") {
        /**
         * kode ini untuk menghandle error
         * dimana server mengirimkan respon selain yes dan no
         */

         console.log(this.responseText);
    }
}

xhr.open("GET", `/server/detail-lagu/ajax.php?q=isadmin&user-id=${userId}`);

xhr.send();