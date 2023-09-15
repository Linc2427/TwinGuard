<?php
require 'config.php';
session_start();
// $conn = mysqli_connect("localhost", "root", "123", "pkm") or die("koneksi gagal");
if (isset($_SESSION['login'])) {
    header("Location: main.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `login` WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['login'] = true;
        header("Location: main.php");
    } else {
        echo "<script>alert('User atau Password Anda salah. Silahkan coba lagi!')</script>";
    }
}
?>

<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>TwinGuard</title>
    <style>
        html {
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
            /* border-width: thin; */
            /* border-style: dashed; */
            /* border-color: crimson; */
            min-height: 100%;
            /* box-sizing: border-box; */
        }

        body {
            /* background-color: #ff4081ff;  */
            text-align: center;
            font-family: 'Lexend Deca', sans-serif;
        }

        h1 {
            color: blue;
        }

        /* img {
            display: inline-block;
            width: 768px;
            margin: 0 auto;
        } */

        @media only screen and (max-width: 650px) {
            img {
                width: 100%;
            }
        }

        /* img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 85%;
        } */

        /* p    {color: red;} */
    </style>
</head>

<body>
    <center><img src="images/twinguard.png"></center>
    <form action="" method="post" enctype="multipart/form">
        <div class="input-field">
            <label class="label">Username:</label>
            <input type="text" class="input col-5" name="username" required autocomplete="off">
        </div>
        <div class="input-field mb-2">
            <label class="label">Password:</label>
            <input type="password" class="input mt-2 col-5" name="password" required>
        </div>
        <div class="input-field mt-5">
            <!-- <a type="submit" class="mx-3 btn btn-outline-success" name="submit">Masuk</button> -->
            <button name="submit" class="btn mx-3 btn-outline-success">Masuk</button>
            <a class="btn btn-outline-primary" aria-current="page" href="register.php">Daftar</a>
        </div>
    </form>
</body>

</html>