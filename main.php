<?php
include 'config.php';
session_start();
error_reporting(0);
if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
if ($_SESSION['login'] != true) {
    echo '<script>window.location="index.php"</script>';
}

if (isset($_POST['submit'])) {
    $user_passcode = $_POST['ipasscode'];
    $username = $_SESSION['username'];

    // Query the database to get the correct passcode for the user
    $query = "SELECT passcode FROM `login` WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $correct_passcode = $row['passcode'];

        if ($user_passcode == $correct_passcode) {
            echo "<script>alert('Passcode Benar!')</script>";
        } else {
            echo "<script>alert('Passcode Salah!')</script>";
        }
    } else {
        echo "<script>alert('Error fetching passcode from the database.')</script>";
    }
}


// $passcode_status = $_GET['passcode_status'];

// if ($passcode_status === "1") {
//     echo "<script>alert('Passcode Benar!');</script>";
// } elseif ($passcode_status === "0") {
//     echo "<script>alert('Passcode Salah!');</script>";
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
            /* border-width: thin; */
            /* border-style: dashed; */
            /* border-color: crimson; */
            min-height: 100%;
            /* box-sizing: border-box; */
        }

        body {
            background-color: #FBEEAC;
            text-align: center;
            font-family: 'Lexend Deca', sans-serif;
        }

        .card {
            /* background-color: #1D5D9B; */
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

        /* h1 {
            color: blue;
        } */

        img {
            display: inline-block;
            width: 83%;
            margin: 0 auto;
        }

        /* @media only screen and (max-width: 650px) {
            img {
                width: 20%;
            }
        } */

        /* img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 85%;
        } */

        /* p    {color: red;} */
        .logout-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
    </style>
</head>

<body>
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
                    <button type="button" class="btn btn-secondary mt-3" id="cancel-button">Cancel</button>
                </form>
            </div>
            <div id="button-container">
                <button class="btn btn-outline-success col-4 mx-2" id="passcode-button" name="passcode-button">Passcode</button>
                <a class="btn btn-outline-warning col-4" id="lacak-button" href="maps.php">Lacak</a>
            </div>
            <!-- <button class="btn btn-outline-success col-4 mx-2" id="passcode-button">Passcode</button>
            <a class="btn btn-outline-warning col-4" id="lacak-button" href="track.php">Lacak</a> -->
        </div>
    </div>
    <a href="logout.php" class="logout-button btn btn-danger" id="logout-button">logout</a>

    <script>
        document.getElementById("passcode-button").addEventListener("click", function() {
            document.getElementById("passcode-form").style.display = "block";
            document.getElementById("button-container").style.display = "none";
            // document.getElementById("passcode-button").style.display = "none";
            // document.getElementById("lacak-button").style.display = "none";
            document.getElementById("logout-button").style.display = "none";
        });

        document.getElementById("cancel-button").addEventListener("click", function() {
            document.getElementById("passcode-form").style.display = "none";
            document.getElementById("button-container").style.display = "block";
            // document.getElementById("passcode-button").style.display = "block";
            // document.getElementById("lacak-button").style.display = "block";
            document.getElementById("logout-button").style.display = "block";
        });
    </script>
</body>

</html>
