<?php
require 'config.php';
error_reporting(0);

session_start();
if (isset($_SESSION['login'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    // $email = $_POST['email'];
    $password = ($_POST['password']);
    $cpassword = ($_POST['cpassword']);
    $passcode = ($_POST['passcode']);
    $cpasscode = ($_POST['cpasscode']);

    if ($password == $cpassword && $passcode == $cpasscode) {
        $sql2 = "SELECT * FROM login WHERE username='$username'";
        $result = mysqli_query($conn, $sql2);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO `login` (`username`, `password`, `passcode`) VALUES ('$username','$password', '$passcode')";
            // $miqdad .= "INSERT INTO `passcode` (`is_read`) VALUES (NULL)";
            // $sql3 = "INSERT INTO `passcode` (`is_read`) VALUES (NULL)";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "Success";
            } else {
                echo "gagal";
            }
        } else {
            echo "<script>alert('Akun Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password/Passcode Tidak Sesuai')</script>";
    }
    $sql3 = "INSERT INTO `passcode` (`is_read`) VALUES ('0')";
    if ($conn->query($sql3) === TRUE) {
        echo "<script>alert('Berhasil.')</script>";
    } else {
        echo "<script>alert('Gagal.')</script>";
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
    <title>TwinGuard-Daftar</title>
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
            vertical-align: middle
        }

        h1 {
            /* color: blue; */
            font-size: 50px;
        }

        /* img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 75%;
        } */

        /* p    {color: red;} */
    </style>
</head>

<body>
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Daftar Akun</h1>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form">
                <br>
                <table class="table table-responsive">
                    <tbody>
                        <tr>
                            <th>Username</th>
                            <th><input type="text" name="username" required></th>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <th><input type="password" name="password" required></th>
                        </tr>
                        <tr>
                            <th>Konfirmasi Password</th>
                            <th><input type="password" name="cpassword" required></th>
                        </tr>
                        <tr>
                            <th>Passcode</th>
                            <th><input type="number" name="passcode" required></th>
                        </tr>
                        <tr>
                            <th>Konfirmasi Passcode</th>
                            <th><input type="number" name="cpasscode" required></th>
                        </tr>
                    </tbody>
                </table>
                <div class="input-field mt-5">
                    <!-- <a type="submit" name="submit" href="index.php" class="mx-3 btn btn-outline-success">Daftar</button> -->
                    <button name="submit" class="mx-3 btn btn-outline-success">Daftar</button>
                    <a class="btn btn-outline-primary" href="index.php" class="mx-3 btn btn-outline-success">Kembali</a>
                </div>
        </div>
    </div>
    </div>
    </form>

</body>

</html>