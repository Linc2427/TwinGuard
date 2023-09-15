<?php
//error: Google Maps JavaScript API error: ApiNotActivatedMapError
//solution: click "APIs and services" Link
//			click "Enable APIs and services" button
//			Select "Maps JavaScript API" then click on enable

require 'config.php';

// $sql = "SELECT * FROM track";
// $result = $db->query($sql);
// if (!$result) { {
//     echo "Error: " . $sql . "<br>" . $db->$error;
//   }
// }
$sql = "SELECT * FROM track";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

// print_r($row);

$averageLat = 0;
$averageLng = 0;
$markerCount = count($rows);

foreach ($rows as $location) {
    $averageLat += $location['Latitude'];
    $averageLng += $location['Longitude'];
}

$averageLat /= $markerCount;
$averageLng /= $markerCount;

//header('Content-Type: application/json');
//echo json_encode($rows);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>TwinGuard-Tracking</title>
    <style>
        html {
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
            min-height: 100%;
        }

        body {
            text-align: center;
            font-family: 'Lexend Deca', sans-serif;
            background-color: #FBEEAC;
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

        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h1>Maps</h1>
        </div>
        <div class="card-body">
            <div id="map"></div>
            <div id="button-container" class="mt-3">
                <a class="btn btn-outline-warning" id="kembali-button" href="main.php">Kembali</a>
                <button onClick="window.location.reload();" class="btn btn-outline-success mx-2" id="refresh-button" href="track.php">Refresh</button>
                <a class="btn btn-outline-danger" id="logout-button" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
    <script>
        var map = L.map('map').setView([<?php echo $averageLat; ?>, <?php echo $averageLng; ?>], 5);

        var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        <?php foreach ($rows as $location) { ?>
            L.marker([<?php echo $location['Latitude']; ?>, <?php echo $location['Longitude']; ?>]).addTo(map)
                .bindPopup('<p>Latitude: </p><?php echo $location['Latitude']; ?>, <p>Longitude: </p><?php echo $location['Longitude']; ?>'); // Ganti NamaLokasi dengan nama kolom di database Anda
        <?php } ?>
    </script>
</body>

</html>