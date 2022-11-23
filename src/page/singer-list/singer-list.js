window.onload = () => {
    // NAV
    const nav = document.getElementsByClassName('nav')[0];
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/server/nav/nav.php`);
    xhr.onload = function() {
        nav.innerHTML = this.responseText;
    }
    xhr.send();
}

const table = document.getElementsByClassName("table")[0];

// table.innerHTML = "";

const xhr = new XMLHttpRequest();

xhr.open("GET", "/server/singer-list/ajax.php");

xhr.onload = function() {
    table.innerHTML = "";
    console.log(this.responseText);
    
    const tableHead = document.createElement("thead");

    /**
     * Membuat bagian paling atas table
     */

    const titleRow = document.createElement("tr");

    const titleSingerCol = document.createElement("th");
    titleSingerCol.innerHTML = "Singer";

    const emptyCol1 = document.createElement("th");
    const emptyCol2 = document.createElement("th");

    const titleSubscribeCol = document.createElement("th");
    titleSubscribeCol.className = "ctr";
    titleSubscribeCol.innerHTML = "Subscribe";

    const titleStatusCol = document.createElement("th");
    titleStatusCol.className = "ctr";
    titleStatusCol.innerHTML = "Status";

    /**
     * Adding the column into the row
     */

    titleRow.appendChild(titleSingerCol);
    titleRow.appendChild(emptyCol1);
    titleRow.appendChild(emptyCol2);
    titleRow.appendChild(titleSubscribeCol);
    titleRow.appendChild(titleStatusCol);

    tableHead.appendChild(titleRow);

    /**
     * Adding the singer into the table
    */
    
    const singerList  = JSON.parse(this.responseText);
    
    singerList.forEach(elem => {
        const singer = elem["singer-name"];
        const status = elem["status"];

        const singerRow = document.createElement("tr");
        
        const singerCol = document.createElement("th");
        singerCol.innerHTML = singer;
        
        const emptyCol1 = document.createElement("th");
        const emptyCol2 = document.createElement("th");
        
        const subscribeCol = document.createElement("th");
        subscribeCol.className = "ctr";
        
        const subscribeButton = document.createElement("button");
        subscribeButton.className = "subscribe";
        subscribeButton.textContent = status === "Granted" ? "Unsubscribe" : "Subscribe";
        
        subscribeCol.appendChild(subscribeButton);
        
        const statusCol = document.createElement("th");
        statusCol.className = "ctr";
        statusCol.innerHTML = status;
        
        singerRow.appendChild(singerCol);
        singerRow.appendChild(emptyCol1);
        singerRow.appendChild(emptyCol2);
        singerRow.appendChild(subscribeCol);
        singerRow.appendChild(statusCol);
        
        tableHead.appendChild(singerRow);
    })

    table.appendChild(tableHead);
}

xhr.send();