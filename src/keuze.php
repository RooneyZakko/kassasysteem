<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toevoegen of afrekenen</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        div {
            margin: 10px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #3498db;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #207cca;
        }
    </style>
</head>
<body>
<?php
$idTafel = $_GET['idtafel'] ?? false;
if ($idTafel) {
    echo "<div><a href='product.php?idtafel={$idTafel}'>toevoegen</a></div>";
    echo "<div><a href='rekening.php?idtafel={$idTafel}'>afrekenen</a></div>";
} else {
    http_response_code(404);
    include('error_404.php');
    die();
}
?>
</body>
</html>