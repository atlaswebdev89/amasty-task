<?php

declare(strict_types=1);

namespace App\Service;

use GuzzleHttp\Client;

class Exchanger
{

    /**
     * URL exchanges
     */
    const string URL = 'https://api.nbrb.by/exrates/rates/431';

    /**
     * @var Client
     */
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getExchangeRates(): mixed
    {
        $rate = null;
        $response = $this->client->request('GET', self::URL);
        $rates = json_decode($response->getBody()->getContents(), true);

        if (!empty($rates['Cur_OfficialRate'])) {
            $rate = $rates['Cur_OfficialRate'];
        }

        return $rate;
    }
}