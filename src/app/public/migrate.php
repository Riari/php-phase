<?php

// This is a temporary solution for executing migrations

require __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager;

use Phase\App\App;

$app = new App(__DIR__ . '/../');

Manager::schema()->create('posts', function ($table) {
    $table->increments('id');
    $table->string('title');
    $table->text('content');
    $table->timestamps();
});