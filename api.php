<?php
include "config.php";
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
if (isset($_POST['lat']) && isset($_POST['lng'])) {
    $sql = "INSERT INTO `track` (`id`, `latitude`, `longitude`) VALUES (NULL, '" . $_POST['lng'] . "', '" . $_POST['lat'] . "');";
    $res = mysqli_query($conn, $sql);
}
if (isset($_POST['passcode'])) {
    $sql = "SELECT * FROM passcode WHERE is_read = 0";
    $res = mysqli_query($conn, $sql);
    $res = mysqli_fetch_object($res);

    $sql = "UPDATE `passcode` SET `is_read` = '" . $_POST['passcode'] . "' WHERE `passcode`.`id` = " . $res->id . ";";
    $res = mysqli_query($conn, $sql);
}
$sql = "SELECT * FROM passcode WHERE is_read = 0";
$res = mysqli_query($conn, $sql);
$res = mysqli_fetch_object($res);
if ($res) {
    echo json_encode([
        "passcode" => "1"
    ]);
} else {
    echo json_encode([
        "passcode" => "0"
    ]);
}

