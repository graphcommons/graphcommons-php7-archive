<?php require('test-inc.php');

define('API_KEY', 'sk_Bb9mIS0oQy8XBS8OX0ZHNg');

$autoload = require('../GraphCommons/Autoload.php');
$autoload->register();

use GraphCommons\GraphCommons;

// $config = array(
//     'api_url' => 'http://localhost/foo.json',
//     'api_version' => '',
// );
// $gc = new GraphCommons(API_KEY, $config);

$gc = new GraphCommons(API_KEY);
// pre($gc);

// $data = $gc->api->status();

// 8f8c794a-a498-4c3e-a73b-95a460db6e3a
$data = $gc->api->graph('8f8c794a-a498-4c3e-a73b-95a460db6e3a');

pre($data);

// $client = $gc->getClient();
// $client->get('');
// pre($client);
