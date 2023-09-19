<?php
include 'config.php';
session_start();
error_reporting(0);

if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    echo '<script>window.location="index.php"</script>';
}

// update is_read menjadi 1
// function updateIsReadTo1($conn, $id)
// {
//     $updateQuery = "INSERT INTO `passcode` (`id`, `is_read`) VALUES (NULL, '1');";
//     if (mysqli_query($conn, $updateQuery)) {
//         return true; // Berhasil mengupdate
//     } else {
//         return false; // Gagal mengupdate
//     }
// }

// update is_read menjadi 0
function updateIsReadTo0($conn, $id)
{
    $updateQuery = "INSERT INTO `passcode` (`id`, `is_read`) VALUES (NULL, '0');";
    if (mysqli_query($conn, $updateQuery)) {
        return true; // Berhasil 
    } else {
        return false; // Gagal 
    }
}

if (isset($_POST['submit'])) {
    $user_passcode = $_POST['ipasscode'];
    $username = $_SESSION['username'];

    // Query the database to get the correct passcode for the user
    $query = "SELECT passcode, id FROM `login` WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $correct_passcode = $row['passcode'];
        $id = $row['id'];

        if ($user_passcode == $correct_passcode) {
            // Passcode benar, maka update is_read menjadi 1
            if (updateIsReadTo0($conn, $id)) {
                echo "<script>alert('Passcode Benar!')</script>";
            } else {
                echo "<script>alert('Gagal mengupdate is_read.')</script>";
            }
        } else {
            echo "<script>alert('Passcode Salah!')</script>";
        }
    } else {
        echo "<script>alert('Error fetching passcode from the database.')</script>";
    }
}

// Proses logout
// if (isset($_POST['hidup'])) {
//     // id session
//     $id = $_SESSION['id'];

//     // memanggil fungsi ubah ke 0 saat logout
//     if (updateIsReadTo0($conn, $id)) {
//         echo "<script>alert('berhasil hidupkan alat.')</script>";
//     } else {
//         echo "<script>alert('Gagal mengupdate is_read.')</script>";
//     }

//     // // Hapus semua data sesi
//     // $_SESSION = [];

//     // // Hancurkan sesi
//     // session_destroy();

//     // // Alihkan pengguna ke halaman login
//     // header("Location: index.php");
// }
?>

<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>TwinGuard-Main Menu</title>
    <style>
        html {
            max-width: 370px;
            margin-left: auto;
            margin-right: auto;
            min-height: 100%;
        }

        body {
            background-color: #FBEEAC;
            text-align: center;
            font-family: 'Lexend Deca', sans-serif;
        }

        .card {
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            font-family: 'Lexend Deca', sans-serif;
        }

        .card-header {
            background-color: #1D5D9B;
            text-align: center;
            font-family: 'Lexend Deca', sans-serif;
        }

        img {
            display: inline-block;
            width: 83%;
            margin: 0 auto;
        }

        .logout-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
    </style>
</head>

<body>
    <!-- <?php echo $id; ?> -->
    <div class="card">
        <div class="card-header text-light">
            <h1>Halo
                <?php
                $pengguna = $_SESSION['username'];
                $Upengguna = strtoupper($pengguna);
                echo $Upengguna;
                ?></h1>
        </div>
        <div class="card-body">
            <img src="images/twinguard.png">
            <div class="input-field mt-5" id="passcode-form" style="display: none;">
                <form method="POST">
                    <input type="number" class="form-control" id="passcode-input" placeholder="Masukkan passcode" name="ipasscode" required>
                    <button type="submit" class="btn btn-primary mt-3" name="submit">Submit</button>
                    <!--<button type="submit" class="btn btn-success mt-3" name="hidup">Hidupkan Alat</button>-->
                    <button type="button" class="btn btn-secondary mt-3" id="cancel-button">Cancel</button>
                </form>
            </div>
            <div id="button-container">
                <button class="btn btn-outline-success col-4 mx-2" id="passcode-button" name="passcode-button">Passcode</button>
                <a class="btn btn-outline-warning col-4" id="lacak-button" href="maps.php">Lacak</a>
            </div>
        </div>
    </div>
    <a href="logout.php" class="logout-button btn btn-danger" id="logout-button" name="logout">logout</a>

    <script>
        document.getElementById("passcode-button").addEventListener("click", function() {
            document.getElementById("passcode-form").style.display = "block";
            document.getElementById("button-container").style.display = "none";
            document.getElementById("logout-button").style.display = "none";
        });

        document.getElementById("cancel-button").addEventListener("click", function() {
            document.getElementById("passcode-form").style.display = "none";
            document.getElementById("button-container").style.display = "block";
            document.getElementById("logout-button").style.display = "block";
        });
    </script>
</body>

</html>
