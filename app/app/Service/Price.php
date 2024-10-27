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
        $result = [];
        if (count($data)) {
            $pricePizza = (!empty($data['pizza']['price']) && !empty($data['size']['price_ratio']))
                ? $data['pizza']['price'] * $data['size']['price_ratio']
                : false;
            $priceSauce = $data['sauce']['price'] ?? false;
            $priceTotal = $pricePizza + $priceSauce;

            if ($requestData['currency'] == 'byn') {
                $rate = $this->exchanger->getExchangeRates();
                $priceTotal *= $rate;
            }

            $result = [
                'Name Pizza'  => $data['pizza']['name'] ?? null,
                'Size Pizza'  => $data['size']['size'] ?? null,
                'Price Pizza' => $pricePizza ?? null,
                'Sauce Name'  => $data['sauce']['name'] ?? null,
                'Price Sauce' => $data['sauce']['price'] ?? null,
                'Total Price' => round($priceTotal, 2),
            ];
        }

        return $result;
    }
}