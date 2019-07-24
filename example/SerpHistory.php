<?php

use InboundAsia\Ranking\Ranking;

require __DIR__ . '/../vendor/autoload.php';

$rustart = getrusage();

// Load API Key from .env
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
$key = getenv('API_KEY');

$result = (new Ranking($key))->serp_history([
    "玻尿酸", "敏感肌"
], "https://bffect.com", '2019-07-01,2019-07-10');

print_r($result);

function rutime($ru, $rus, $index) {
    return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
     -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
}

$ru = getrusage();
echo "This process used " . rutime($ru, $rustart, "utime") .
    " ms for its computations\n";
echo "It spent " . rutime($ru, $rustart, "stime") .
    " ms in system calls\n";




