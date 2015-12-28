<?php require('test-inc.php');

define('API_KEY', file_get_contents('./../.apikey'));

$autoload = require('../GraphCommons/Autoload.php');
$autoload->register();

use GraphCommons\GraphCommons;
use GraphCommons\Graph\Graph;
use GraphCommons\Graph\Signal;
use GraphCommons\Graph\SignalCollection;

$gc = new GraphCommons(API_KEY, ['debug' => true]);
// pre($gc);

// check status
$data = $gc->api->status();

// get graph
// $data = $gc->api->getGraph('8f8c794a-a498-4c3e-a73b-95a460db6e3a');

// add graph
// $data = $gc->api->addGraph((function() {
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

// add graph signal
// $data = $gc->api->addGraphSignal(
//     '29d02ccc-fcd5-4b9c-aa74-bd1033b6d3bd', SignalCollection::fromArray(array(
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
// )));

// get node
// $data = $gc->api->getNode('255905e9-c82f-4468-a659-7139dd66d810');

// get nodes
// $data = $gc->api->getNodes(array(
//     'query' => 'kerem',
//     'limit' => 1,
// ));

// dump data
// pre($data);

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
