<?php
require 'vendor/autoload.php';

use XYO\SDK\Client;
use XYO\SDK\ClientConfig;


$client = new Client(new ClientConfig("YourAPIKeyShouldBePlacedAsParameterHere"));

try {
    echo $client->getHeath();
} catch (Throwable $e) {
    echo sprintf('error: %s', $e->getMessage());
}
