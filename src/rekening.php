<?php

use Acme\classes\Rekening;

// Stel de tijdzone in op 'Europe/Amsterdam'
date_default_timezone_set('Europe/Amsterdam');

require "../vendor/autoload.php";

$idTafel = $_GET['idtafel'] ?? null;
if ($idTafel) {

    // TODO: bestelling ophalen en tonen op een mooie manier door gebruik te maken van Rekening.php
    $rekening = new Rekening($idTafel);

    // Haal de rekeninggegevens op
    $bill = $rekening->getBill();

    // Toon de rekening op een mooie manier 
    echo "<h1>Rekeningoverzicht</h1>";
    echo "<p>Tafelnummer: {$bill['tafel'][0]}</p>";

    echo "<p>Datum: {$bill['datumtijd']['formatted']}</p>";
    echo "<p>Tijd:  {$bill['datumtijd']['time']}</p>";
    echo "<p>Totaal: {$bill['totaal']}</p>";

    // Toon betaald status
    echo "<p>Betaald: ";
    echo isset($bill['betaald']) ? ($bill['betaald'] ? 'Ja' : 'Nee') : 'Nee';
    echo "</p>";

    // Toon toegevoegde producten
    echo "<p>Toegevoegde items:</p>";
    if (isset($bill['products'])) {
        echo "<ul>";
        foreach ($bill['products'] as $idProduct => $productData) {
            $productName = $productData['data']['naam'];
            $productCount = $productData['aantal'];
            echo "<li>$productName (Aantal: $productCount)</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Geen producten toegevoegd</p>";
    }

    // TODO: bestelling op betaald zetten
    $rekening->setPaid();

} else {
    http_response_code(404);
    include('error_404.php');
    die();
}