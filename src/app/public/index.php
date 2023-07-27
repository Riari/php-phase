<?php

require __DIR__ . '/../../vendor/autoload.php';

use Phase\App\App;

$app = new App(__DIR__ . '/../');
$app->run();