const table = document.getElementsByClassName("table")[0];

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

const update = (cb, time) => {
    let timeoutId = null;
    const func = () => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(cb,time);
    }

    return func;
}

function displayTable() {
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
        
        singerList.forEach((elem, index) => {
            const singer = elem["singer-name"];
            const status = elem["status"];

            const singerRow = document.createElement("tr");
            
            const singerCol = document.createElement("th");
            singerCol.innerHTML = singer;
            
            const emptyCol2 = document.createElement("th");
            
            /**
             * Handling the display according to the status
             */
            const singerLinkCol = document.createElement("th");
            const subscribeCol = document.createElement("th");
            subscribeCol.className = "ctr";

            if(elem.status === "PENDING") {
                const subscribeButton = document.createElement("button");
                subscribeButton.className = "waiting";
                subscribeButton.textContent = "Subscribe";
                
                subscribeCol.appendChild(subscribeButton);

            } else if(elem.stats === "ACCEPTED") {
                /**
                 * TODO: linking href to react
                 */
                const singerLinkHref = document.createElement("a");

                const singerLinkButton = document.createElement("button");
                singerLinkButton.className = "btn";
                singerLinkButton.textContent = "Visit Singer page";

                singerLinkHref.appendChild(singerLinkButton);
                singerLinkCol.appendChild(singerLinkHref);
                
            } else if(elem.status === "REJECTED" || elem.status === "") {
                const subscribeButton = document.createElement("button");
                subscribeButton.className = "subscribe";
                subscribeButton.textContent = "Subscribe";
                subscribeButton.onclick = () => {
                    const xhr = new XMLHttpRequest();
                    
                    xhr.onloadend = function() {
                        console.log(this.responseText);
                    };

                    xhr.open("GET", `/server/singer-list/request-subscription.php?creator_id=${singer}`);

                    xhr.send();

                    window.location.reload();
                };

                subscribeCol.appendChild(subscribeButton);
                
            } else {
                alert("Invalid status received");
            }
            
            const statusCol = document.createElement("th");
            statusCol.className = "ctr";
            if(elem.status === "ACCEPTED") {
                statusCol.className = "ctr granted";
            } else if(elem.status === "REJECTED") {
                statusCol.className = "ctr rejected";
            }
            statusCol.innerHTML = status;
            
            singerRow.appendChild(singerCol);
            singerRow.appendChild(singerLinkCol);
            singerRow.appendChild(emptyCol2);
            singerRow.appendChild(subscribeCol);
            singerRow.appendChild(statusCol);
            
            tableHead.appendChild(singerRow);
        })

        table.appendChild(tableHead);
    }

    xhr.send();
}

// Polling
update(() => {
    const xhr = new XMLHttpRequest();
    xhr.onloadend = function() {
        displayTable();
        console.log("Subscription table successfully polled");
    }

    xhr.open("GET", "/server/utils/poll-subscription.php");

    xhr.send();
}, 20000);
