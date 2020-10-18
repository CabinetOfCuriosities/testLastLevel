<?php

namespace Controllers;

use Services\Calculate as CalculateService;
use Services\Card;
use Services\File;

class Calculate
{
    public function showComissions($filename)
    {
        $card = new Card();
        $file = new File();
        $calculateService = new CalculateService($card, $file);
        $result = $calculateService->calculate($filename);

        foreach ($result as $amount) {
            echo $amount;
            print "\n";
        }
    }
}