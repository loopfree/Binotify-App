<?php
session_start();

echo $_SESSION['user_id'];

require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';

$query = "SELECT creator_id FROM \"Subscription\" WHERE subscriber_id=$1;";

$result = pg_query_params($conn, $query, [$_SESSION['user_id']]);

$content = "";

// function CallAPI($method, $url, $data = false)
// {
//     echo "CallAPI";
//     $curl = curl_init();

//     switch ($method)
//     {
//         case "POST":
//             curl_setopt($curl, CURLOPT_POST, 1);

//             if ($data)
//                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//             break;
//         case "PUT":
//             curl_setopt($curl, CURLOPT_PUT, 1);
//             break;
//         default:
//             if ($data)
//                 $url = sprintf("%s?%s", $url, http_build_query($data));
//     }
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//     // // Optional Authentication:
//     // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//     // curl_setopt($curl, CURLOPT_USERPWD, "username:password");

//     // curl_setopt($curl, CURLOPT_URL, $url);
//     // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

//     $result = curl_exec($curl);
//     echo $result;

//     curl_close($curl);

//     return $result;
// }

for ($row = 0; $row < pg_num_rows($result); $row++) {
    $creator_id = pg_fetch_result($result, $row, "creator_id");
    $content .= "
      <input type=hidden class='creator-id' creator_id=$creator_id>
    "
    // // echo $creator_id;
    // // call rest api
    // $url = "http://catify-rest:3000/premium_singer/list";
    // // $ch = curl_init($url);
    // // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $response = CallAPI("GET", $url);
    // echo($response);
    // // curl_close($ch);
    // // $response = json_decode($response, true);

    // foreach ($response as $song) {
    //     $song_id = $song['song_id'];
    //     $title = $song['judul'];
    //     $audio_path = $song['audio_path'];
    //     $content .= "
    //         <div class='song-card' audio_path='$audio_path'>
    //             <img 
    //                 src='/assets/img/song-default.png'
    //                 alt=''
    //                 class='song-image'
    //             >
    //             <div class='song-info'>
    //                 <h2 class='song-title'>$title</h2>
    //             </div>
    //             <div class='play-button'>
    //                 <div class='triangle'></div>
    //             </div>
    //         </div>
    //     ";
    // }
}

echo $content;

?>