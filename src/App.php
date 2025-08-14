<?php
require 'vendor/autoload.php';

use XYO\SDK\Client;

$client = new Client();
echo $client->geHealth();
