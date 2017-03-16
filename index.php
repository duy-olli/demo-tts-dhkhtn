<?php

ini_set('default_charset', 'utf-8');
define('ROOT_PATH', dirname(__FILE__));
require_once ROOT_PATH . '/vendor/autoload.php';
libxml_use_internal_errors(true);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

$text = (string) $_GET['text'];

$client = new Client([
    'base_uri' => 'http://www.ailab.hcmus.edu.vn'
]);

$response = $client->request('GET', '/tts_nu/Service.asmx/TTSMp3', [
    'query' => [
        'czt' => 'ailab_khtn',
        'noidung' => $text
    ]
]);

$xmlBody = (string) $response->getBody(); //get xml string

$xmlElement = simplexml_load_string($xmlBody);
// $storePath = ROOT_PATH . '/public/voice.mp3';
// file_put_contents($storePath, base64_decode($xmlElement[0]));

// return direct base64encode data
echo $xmlElement[0];
