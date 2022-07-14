<?php

include_once "autoload.php";

use App;
use Ds\Set;

$config = new App\Config();
$reader = new App\LogReader($config->logPath);
$hits = 0;
$trafic = 0;
$uniqueUrl = new Set();
$responseCodeCounter = new App\Counter('responseCodes');
$botsCounter = new App\Counter('bots');

foreach ($reader->read() as $raw) {
    if (empty($raw)) continue;
    $rawInterpreter = new App\RawInterpreter($raw);
    $uniqueUrl->add($rawInterpreter->url);
    $responseCodeCounter->add($rawInterpreter->responseCode);
    if (!empty($rawInterpreter->searchBot)) $botsCounter->add($rawInterpreter->searchBot);
    $trafic += intval($rawInterpreter->trafic);
    $hits++;
}

$result = [
    'hits' => $hits,
    'trafic' => $trafic,
    'urls' => $uniqueUrl->count()
];
$result = array_merge($result, $responseCodeCounter->getResult());
$result = array_merge($result, $botsCounter->getResult());

printf(json_encode($result));

