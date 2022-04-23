<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Data Realtime Pencairan Dana</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/Chart.js"></script>
    <script>
        $(document).ready(function() {
            $("#responsecontainer").load("data.php");
            var refreshId = setInterval(function() {
                $("#responsecontainer").load('data.php');
            }, 36000);
        });
    </script>
</head>

<body>
    <div class="jumbotron text-center">
        <h1>Informasi Realisasi Pencairan Dana</h1>
        <p>Posisi proses pencairan dana mulai SPP-SPM-SP2D</p>
    </div>
    <div class="container">
        <canvas style="height:50vh; width:80vw" id="myChart"></canvas>
        <div id="responsecontainer" class="text-center"></div>
    </div>
</body>

</html>
<script type="text/javascript" src="chartjs/Chart.js"></script>
</body>

</html>