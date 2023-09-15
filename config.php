<?php
$server = "localhost";
$user = "root";
$pass = "123";
$database = "pkm";

//connect to database
$conn = mysqli_connect($server, $user, $pass, $database);

date_default_timezone_set('Asia/Jakarta');

if (!$conn) {
  die("<script>alert('Gagal tersambung dengan database.')</script>");
}
