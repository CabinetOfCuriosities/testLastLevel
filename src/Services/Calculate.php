<?php

namespace Services;

class Calculate
{
    protected const EUR = 'EUR';

    /** @var Card */
    protected $cardService;

    /** @var File */
    protected $fileService;

    public function __construct(Card $cardService, File $fileService)
    {
        $this->cardService = $cardService;
        $this->fileService = $fileService;
    }

    /**
     * @param $rate
     * @param $amount
     * @param $currency
     * @return float|int
     */
    public function getAmount($rate, $amount, $currency)
    {
        $amountFixed = 0;

        if ($this->isEur($currency) || $rate == 0) {
            $amountFixed = $amount;
        }

        if (!$this->isEur($currency) || $rate > 0) {
            $amountFixed = $amount / $rate;
        }

        return $amountFixed;
    }

    /**
     * @param $currency
     * @return bool
     */
    public function isEur($currency)
    {
        return $currency === self::EUR;
    }

    /**
     * @param $filename
     * @return array
     * @throws \Exception
     */
    public function calculate($filename)
    {
        $result = [];
        $file = $this->fileService->readFile($filename);

        foreach (explode("\n", $file) as $row) {
            if (empty($row)) continue;

            $data = $this->fileService->parseStr($row);

            $binList = $this->cardService->getListByBin($data->bin);
            $isEu = $this->cardService->isEu($binList->country->alpha2);

            $rate = $this->cardService->getRate($data->currency);
            $amount = $this->getAmount($rate, $data->amount, $data->currency);

            $result[] = round($amount * ($isEu ? 0.01 : 0.02), 2);
        }

        return $result;
    }
}