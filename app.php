<?php

use Controllers\Calculate;

$classesDir = [
    'src/Controllers/',
    'src/Services/',
];

foreach ($classesDir as $classDir) {
    foreach (glob($classDir . '*.php') as $filename) {
        include $filename;
    }
}

require __DIR__ . '/vendor/autoload.php';

$calculateController = new Calculate();
$result = $calculateController->showComissions($argv[1]);
