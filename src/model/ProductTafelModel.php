<?php

namespace Acme\model;

use Acme\system\Database;

class ProductTafelModel extends Model
{
    protected static string $tableName = "product_tafel";
    protected static string $primaryKey = "idproduct_tafel";

    public function __construct($env = '../.env')
    {
        parent::__construct(Database::getInstance($env));
    }

    /**
     * @param array $bestelling [
     *                          'idtafel'  => int idTafel,
     *                          "products" => array [idproduct, idproduct, ...],
     *                          "datetime" => int dateTime
     *                          ]
     *  
     * @return int nieuwe id
     */
    public function saveBestelling(array $bestelling): int
    {
     $bestellingId = 0;

    // Loop over alle producten in de bestelling en voeg ze één voor één toe
    foreach ($bestelling['products'] as $idProduct) {
        $this->setColumnValue('idtafel', $bestelling['idtafel']);
        $this->setColumnValue('datumtijd', $bestelling['datetime']);
        $this->setColumnValue('betaald', 0);
        $this->setColumnValue('idproduct', $idProduct);

        // Als het toevoegen van het product aan de bestelling is geslaagd, sla het bestellings-ID op
        $bestellingId = $this->save();
    }

    return $bestellingId;
}

    /**
     * @param $idTafel
     * 
     * @return array    [
     * 'idTafel'  => int idTafel,
     * "products" => array [idproduct, idproduct, ...],
     * "datumtijd" => int dateTime,
     * "betaald" => int betaald
     * ]
     */
    public function getBestelling($idTafel): array
    {
        $products = $this->getAll(['idtafel' => $idTafel, 'betaald' => 0]);

        $bestelling['idTafel'] = $idTafel;
        $bestelling['datumtijd'] = isset($products[0])
            ? (int)$products[0]->getColumnValue('datumtijd') : 0;
        $bestelling['betaald'] = 0;

        foreach ($products as $product) {
            $idProduct = $product->getColumnValue('idproduct');
            $bestelling['products'][] = $idProduct;
        }
        return $bestelling;
    }

    /**
     * Markeer de rekening als betaald
     *
     * @param int $idTafel
     * @return bool
     */
    public function markBillAsPaid(int $idTafel): bool
    {
        $data = ['betaald' => 1];
        $conditions = ['idtafel' => $idTafel, 'betaald' => 0];

        return $this->update($data, $conditions);
    }

    /**
     * Update de gegeven gegevens in de database op basis van de opgegeven voorwaarden
     *
     * @param array $data Gegevens om bij te werken
     * @param array $conditions Voorwaarden waaraan moet worden voldaan voor de update
     * @return bool True als de update is geslaagd, anders false
     */
    public function update(array $data, array $conditions): bool
    {
        return parent::update($data, $conditions);
    }
}