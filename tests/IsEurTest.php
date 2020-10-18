<?php

require_once __DIR__ . '/../src/Services/Calculate.php';

use PHPUnit\Framework\TestCase;
use Services\Calculate;
use Services\Card;
use Services\File;

class IsEurTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIsEu($currency, $expected)
    {
        $card = new Card();
        $file = new File();
        $calculateService = new Calculate($card, $file);
        $this->assertSame($expected, $calculateService->isEur($currency));
    }

    public function additionProvider()
    {
        return [
            ['EUR', true],
            ['USD', false],
            ['RUB', false]
        ];
    }
}