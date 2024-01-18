<?php

namespace Acme\classes;

use Acme\model\ProductModel;
use Acme\model\ProductTafelModel;
use Acme\model\TafelModel;
use DateTime;

class Rekening
{
    private $idTafel;

    public function __construct($idTafel)
    {
        $this->idTafel = $idTafel;
    }

    public function setPaid(): void
    {
        //TODO: de rekening voor een bepaalde tafel op betaald zetten
        $ptm = new ProductTafelModel();
        $ptm->markBillAsPaid($this->idTafel);
    }

    /**
     * @return array
     */
    public function getBill(): array
    {
        $bill = [];
        $bm = new ProductTafelModel();
        $bestelling = $bm->getBestelling($this->idTafel);

        $tm = new TafelModel();

        $bill['tafel'] = $tm->getTafel($this->idTafel);
        $bill['datumtijd'] = [
            'timestamp' => $bestelling['datumtijd'],
           'formatted' => date(
            'd-m-Y', $bestelling['datumtijd']
           ),
           'time' => date(
            'H:i:s', $bestelling['datumtijd']
            ),

            
        ];
        if (isset($bestelling['products'])) {
            foreach ($bestelling['products'] as $idProduct) {
                if (!isset($bill['products'][$idProduct]['data'])) {
                    $bill['products'][$idProduct]['data'] = (new ProductModel())->getProduct($idProduct);
                }
                if (!isset($bill['products'][$idProduct]['aantal'])) {
                    $bill['products'][$idProduct]['aantal'] = 0;
                }
                $bill['products'][$idProduct]['aantal']++;
            }
        }

        //TODO: 'totaal' toevoegen aan de rekening
        $bill['totaal'] = 0;

        return $bill;
    }
}