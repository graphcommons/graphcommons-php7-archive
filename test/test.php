<?php require('test-inc.php');

define('API_KEY', 'sk_Bb9mIS0oQy8XBS8OX0ZHNg');

$autoload = require('../GraphCommons/Autoload.php');
$autoload->register();

use GraphCommons\GraphCommons;
use GraphCommons\Graph\Graph;
use GraphCommons\Graph\Signal;
use GraphCommons\Graph\SignalCollection;

$gc = new GraphCommons(API_KEY, ['debug' => true]);
// pre($gc);

// check status
// $data = $gc->api->status();

// get graph
// $data = $gc->api->getGraph('8f8c794a-a498-4c3e-a73b-95a460db6e3a');

// post graph
// $data = $gc->api->postGraph((function() {
//     $graph = new Graph();
//     $graph->setName('Person Graph');
//     $graph->setDescription('The Person Graph!');
//     $graph->setStatus(Graph::STATUS_DRAFT);
//     $graph->setSignals(SignalCollection::fromArray(array(
//         array(
//             'action'        => Signal::NODE_CREATE,
//             'parameters'    => array(
//                 'name'      => 'Ahmet',
//                 'type'      => 'Person',
//             ),
//         ),
//         array(
//             'action'        => Signal::EDGE_CREATE,
//             'parameters'    => array(
//                 'from_name' => 'Ahmet',
//                 'from_type' => 'Person',
//                 'to_name'   => 'Burak',
//                 'to_type'   => 'Person',
//                 'name'      => 'COLLABORATED',
//                 'weight'    => 2,
//             ),
//         ),
//     )));
//     return $graph;
// })());

// $data = $gc->api->putGraph('29d02ccc-fcd5-4b9c-aa74-bd1033b6d3bd', (function() {
//     $graph = new Graph();
//     $graph->setName('Person Graph (update)');
//     $graph->setDescription('The Person Graph! (update)');
//     $graph->setStatus(Graph::STATUS_PUBLISHED);
//     $graph->setSignals(SignalCollection::fromArray(array(
//         array(
//             'action'        => Signal::EDGE_CREATE,
//             'parameters'    => array(
//                 'from_name' => 'Ahmet',
//                 'from_type' => 'Person',
//                 'to_name'   => 'Fatih',
//                 'to_type'   => 'Person',
//                 'name'      => 'COLLABORATED',
//                 'weight'    => 2,
//             ),
//         ),
//     )));
//     return $graph;
// })());

// dump data
pre($data);

// pre(SignalCollection::fromArray(array(
//     array(
//         'action' => Signal::NODE_CREATE,
//         'parameters' => array(
//             'name' => 'The foo',
//             'type' => 'foo',
//         ),
//     ),
//     array(
//         'action' => Signal::NODE_CREATE,
//         'parameters' => array(
//             'from_name' => 'The foo',
//             'from_type' => 'foo',
//             'weight' => 2,
//         ),
//     ),
// )));

// pre(SignalCollection::fromJson('{"signals":[{"action":"node_create","name":"The foo","type":"foo"},{"action":"node_create","from_name":"The foo","from_type":"foo","weight":2}]}'));
