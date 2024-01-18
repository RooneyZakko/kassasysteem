<?php

namespace Acme;

use Acme\model\ProductModel;

require "../vendor/autoload.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

form {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
}

.product {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="checkbox"] {
    margin-right: 5px;
}

input[type="number"] {
    width: 50px;
    margin-left: 5px;
}

button {
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #207cca;
}

    </style>
    
</head>
<body>
<form action="bestellingdoorvoeren.php" method="post">
    <?php

    // QUESTION: Wat doet ?? in de code-regel hier onder?
    // Antwoord:
    // Het controleert of $_GET['idtafel'] is ingesteld. Als deze is ingesteld,
    //  wordt de waarde ervan toegewezen aan $idTafel. Als dit niet is ingesteld,
    //   wordt false toegewezen aan $idTafel. Dit is een beknopte manier om situaties
    //    aan te pakken waarin de variabele mogelijk niet is ingesteld.
    $idTafel = $_GET['idtafel'] ?? false;
    if ($idTafel) {
        echo "<input type='hidden' name='idtafel' value='$idTafel'>";

        // TODO: alle producten ophalen uit de database en als inputs laten zien (maak gebruik van ProductModel class)
        $pm = new ProductModel();
        $products = $pm->getAll();

        foreach ($products as $product) {
            $idproduct = $product->getColumnValue('idproduct');
            $naam = $product->getColumnValue('naam');

            echo "<div>";
            echo "<label><input type='checkbox' name='products[]' value='$idproduct'>$naam</label>";
            echo "<label>Aantal:<input type='number' name='product{$idproduct}'></label>";
            echo "</div>";
        }

        echo "<button>Volgende</button>";
    } else {
        // QUESTION: Wat gebeurt hier?
        // Antwoord:
        // Als $idTafel hier is ingesteld en niet false, wordt de code binnen het if-blok
        //  uitgevoerd. Als het niet ingesteld of false is, reageert het met een 404-fout
        //   en bevat het de pagina 'error_404.php', waarbij het script wordt beëindigd met
        //    die(). Dit is een manier om het geval af te handelen waarin de vereiste
        //     'idtafel'-parameter ontbreekt of ongeldig is.
        http_response_code(404);
        include('error_404.php');
        die();
    }
    ?>

</form>
</body>
</html>
