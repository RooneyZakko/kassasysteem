<?php

use Acme\classes\Bestelling;

require "../vendor/autoload.php";

if ($idTafel = $_POST['idtafel'] ?? false) {
    // Get the selected products from the form
    $selectedProducts = $_POST['products'] ?? [];

    // Create a new Bestelling object
    $bestelling = new Bestelling($idTafel);

    // Add the selected products to the order
    $bestelling->addProducts($selectedProducts);

    // Process and save the order to the database
    $bestelling->saveBestelling();
} else {
    // Handle the case where idtafel is not set
    http_response_code(404);
    include('error_404.php');
    die();
}

header("Location: index.php");