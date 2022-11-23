<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>\(OwO)/</title>
    <link rel="stylesheet" href="singer-list.css">
    <script src="singer-list.js" defer></script>
</head>
<body class="body dark-bg">
    <nav class="nav"></nav>
    <main>
        <h1 class="title">Singer List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Singer</th>
                    <th></th>
                    <th></th>
                    <th class="ctr">Subscribe</th>
                    <th class="ctr">Status</th>
                </tr>
                <tr>
                    <th>Template</th>
                    <th></th>
                    <th></th>
                    <th class="ctr">
                        <button class="subscribe">
                            Subscribe
                        </button>
                    </th>
                    <th class="ctr">
                        " " or "Waiting" or "Granted" or "Rejected"
                    </th>
                </tr>
                <tr>
                    <th>Normal</th>
                    <th></th>
                    <th></th>
                    <th class="ctr">
                        <button class="subscribe">
                            Subscribe
                        </button>
                    </th>
                    <th class="ctr">
                        
                    </th>
                </tr>
                <tr>
                    <th>Waiting (Subs button g bs ditekan)</th>
                    <th></th>
                    <th></th>
                    <th class="ctr">
                        <button class="waiting">
                            Subscribe
                        </button>
                    </th>
                    <th class="ctr">
                        Waiting
                    </th>
                </tr>
                <tr>
                    <th>Granted (tombol subsnya diilangin karena gak bisa unsub) cmiiw -> refer balek ke spek</th>
                    <th>
                        <button class="btn">
                            Ke halaman list lagu premium penyanyi tersebut
                        </button>
                    </th>
                    <th></th>
                    <th class="ctr">

                    </th>
                    <th class="ctr granted">
                        Granted
                    </th>
                </tr>
                <tr>
                    <th>Rejected (bisa subs kembali)</th>
                    <th></th>
                    <th></th>
                    <th class="ctr">
                        <button class="subscribe">
                            Subscribe
                        </button>
                    </th>
                    <th class="ctr rejected">
                        Rejected
                    </th>
                </tr>
            </thead>
            <tbody id="user-table-body"></tbody>
        </table>
    </main>
    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
</body>
</html>