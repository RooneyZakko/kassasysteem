<?php

// In composer.json wordt acme-namespace aan src-folder gekoppeld
// Elk php-bestand moet een namespace hebben, geredeneerd vanuit de src-map (acne-namespace)
namespace Acme;

use Acme\model\TafelModel;

require "../vendor/autoload.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kiezen tafel</title>

    <style>
        
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        div {
            background-color: #fff;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        a {
            text-decoration: none;
            color: blue;
            font-weight: bold;
        }

        a:hover {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Kies een tafel</h1>
<pre>
<?php
    // TODO: alle tafels ophalen uit de database en als hyperlinks laten zien (maak gebruik van class TafelModel) 
    
        $tafelModel = new TafelModel();
        $tafels = $tafelModel->getAll();

        foreach ($tafels as $tafel) {
            $idtafel = $tafel->getColumnValue('idtafel');
            $omschrijving = $tafel->getColumnValue('omschrijving');

            echo "<div><a href='keuze.php?idtafel={$idtafel}'>Tafel: {$omschrijving}</a></div>";
        }
        
    
?>
</body>
</html>
