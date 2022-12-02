<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

function separateNameAndExt($filename) {
    $result = array();
    $ext = "";
    $name = "";
    $extensionIndex = 0;

    for($i = strlen($filename) - 1; $i >= 0; --$i) {
        if($filename[$i] === '.') {
            $extensionIndex = $i;
            break;
        }
    }

    for($i = 0; $i < strlen($filename); ++$i) {
        if($i == $extensionIndex) {
            continue;
        } else if($i > $extensionIndex) {
            $ext .= $filename[$i];
        } else {
            $name .= $filename[$i];
        }
    }
    
    $result += ["ext" => $ext];
    $result += ["name" => $name];
    
    return $result;
}

$currentTime = (string) time();
$imageDir = '/../assets/img/';

$imageName = basename($_FILES['audio']['name']);
$imageName = separateNameAndExt($imageName);

$imageNameHashed = $imageName['name'] . $currentTime;
$imageNameFixed = $imageNameHashed . '.' . $imageName['ext'];

$imageFile = realpath(dirname(getcwd())) . $imageDir . $imageNameFixed;
$sqlImageFile = "/assets/audio/" . $imageNameFixed;

if(!move_uploaded_file($_FILES['audio']['tmp_name'], $imageFile)) {
    echo json_encode(["path" => null]);
}

echo json_encode(["path" => $sqlImageFile]);
?>