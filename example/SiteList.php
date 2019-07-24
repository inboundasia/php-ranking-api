<?php

use InboundAsia\Ranking\Ranking;

require __DIR__ . '/../vendor/autoload.php';

// Load API Key from .env
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
$key = getenv('API_KEY');

$result = (new Ranking($key))->site_list();

print_r($result);
