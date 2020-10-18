<?php

require_once __DIR__ . '/../src/Services/Calculate.php';

use PHPUnit\Framework\TestCase;
use Services\Calculate;
use Services\Card;
use Services\File;

class GetAmountTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIsEu($rate, $amount, $currency, $expected)
    {
        $card = new Card();
        $file = new File();
        $calculateService = new Calculate($card, $file);
        $this->assertSame($expected, $calculateService->getAmount($rate, $amount, $currency));
    }

    public function additionProvider()
    {
        return [
            [2, 3, 'EUR', 1.5],
            [4, 2, 'USD', 0.5],
            [0, 3, 'EUR', 3],
            [5, 3, 'RUB', 0.6]
        ];
    }
}