<?php

namespace Services;

class Card
{
    protected const EU_LIST = [
        'AT',
        'BE',
        'BG',
        'CY',
        'CZ',
        'DE',
        'DK',
        'EE',
        'ES',
        'FI',
        'FR',
        'GR',
        'HR',
        'HU',
        'IE',
        'IT',
        'LT',
        'LU',
        'LV',
        'MT',
        'NL',
        'PO',
        'PT',
        'RO',
        'SE',
        'SI',
        'SK',
    ];
    protected const BIN_URL = 'https://lookup.binlist.net/';
    protected const RATE_URL = 'https://api.exchangeratesapi.io/latest';

    /**
     * @param $bin
     * @return array
     */
    public function getListByBin($bin)
    {
        $binResults = file_get_contents(self::BIN_URL . $bin);
        if (!$binResults) {
            throw new \Exception('Ошибка получения данных lookup.binlist');
        }

        return json_decode($binResults);
    }

    /**
     * @param $currency
     * @return array
     */
    public function getRate($currency)
    {
        $rateResult = file_get_contents(self::RATE_URL);
        return @json_decode($rateResult, true)['rates'][$currency];
    }

    /**
     * @param $c
     * @return bool
     */
    public function isEu($c) {
        return in_array($c, self::EU_LIST);
    }
}