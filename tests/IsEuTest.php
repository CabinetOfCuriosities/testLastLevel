<?php

require_once __DIR__ . '/../src/Services/Card.php';

use PHPUnit\Framework\TestCase;
use Services\Card;

class IsEuTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIsEu($currency, $expected)
    {
        $cardService = new Card();
        $this->assertSame($expected, $cardService->isEu($currency));
    }

    public function additionProvider()
    {
        return [
            ['GR', true],
            ['SK', true],
            ['TT', false]
        ];
    }
}