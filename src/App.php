<?php
require 'vendor/autoload.php';

use XYO\SDK\Client;
use \XYO\SDK\ClientConfig;

$client = new Client(new ClientConfig("YourAPIKeyShouldBePlacedAsParameterHere"));
echo $client->geHealth();
