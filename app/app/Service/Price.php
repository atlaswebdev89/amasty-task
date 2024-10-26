<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Exchanger;

class Price
{
    /**
     * @var Exchanger
     */
    protected Exchanger $exchanger;

    public function __construct()
    {
        $this->exchanger = new Exchanger();
    }

    public function getPrice(array $data, array $requestData = null): array
    {
        echo "<PRE>";
        print_r($data);
        echo "</PRE>";
        $result = [];
        if (count($data)) {
            $pricePizza = $data['pizza']['price'] * $data['size']['price_ratio'];
            $priceSauce = $data['sauce']['price'];
            $priceTotal = $pricePizza + $priceSauce;

            if ($requestData['currency'] == 'byn') {
                $rate = $this->exchanger->getExchangeRates();
                $priceTotal *= $rate;
            }

            $result = [
                'Name Pizza'  => $data['pizza']['name'],
                'Size Pizza'  => $data['size']['size'],
                'Price Pizza' => $pricePizza,
                'Sauce Name'  => $data['sauce']['name'],
                'Price Sauce' => $data['sauce']['price'],
                'Total Price' => round($priceTotal, 2),
            ];
        }

        return $result;
    }
}