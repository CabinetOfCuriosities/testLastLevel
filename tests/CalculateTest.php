<?php

require_once __DIR__ . '/../src/Services/Calculate.php';
require_once __DIR__ . '/../src/Services/Card.php';
require_once __DIR__ . '/../src/Services/File.php';

use PHPUnit\Framework\TestCase;
use Services\Calculate;
use Services\Card;
use Services\File;

class CalculateTest extends TestCase
{
    public function testCalculate()
    {
        $result = [1.71, 0.85, 170.94, 2.22, 34.19];

        $cardService = $this->createMock(Card::class);

        $cardService->method('getListByBin')
            ->willReturn(json_decode(
                '{"number":{"length":16,"luhn":true},"scheme":"visa","type":"debit","brand":"Traditional","prepaid":null,"country":{"numeric":"826","alpha2":"GB","name":"United Kingdom of Great Britain and Northern Ireland","emoji":"🇬🇧","currency":"GBP","latitude":54,"longitude":-2},"bank":{}}'
            ));
        $cardService->method('getRate')->willReturn(1.17);

        $fileService = new File();
        $calculate = new Calculate($cardService, $fileService);
        $this->assertSame($result, $calculate->calculate(__DIR__ . '/test.txt'));
    }
}