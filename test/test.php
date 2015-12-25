<?php require('test-inc.php');

define('API_KEY', 'sk_Bb9mIS0oQy8XBS8OX0ZHNg');

$autoload = require('../GraphCommons/Autoload.php');
$autoload->register();

use GraphCommons\GraphCommons;
use GraphCommons\Graph\Signal;
use GraphCommons\Graph\Signals;

$gc = new GraphCommons(API_KEY);
// pre($gc);

// check status
// $data = $gc->api->status();

// get graph
// $data = $gc->api->getGraph('8f8c794a-a498-4c3e-a73b-95a460db6e3a');

// dump data
// pre($data);

$ss = new Signals();
$ss->add(new Signal(Signal::NODE_CREATE));
$ss->add(new Signal(Signal::NODE_UPDATE));
pre($ss);
