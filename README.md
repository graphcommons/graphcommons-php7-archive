Graph Commons is a collaborative 'network mapping' platform and a knowledge base of relationships. You can map relationships at scale and unfold the mystery about complex issues that impact you and your community.

See more about [here](//graphcommons.com/about).

## GraphCommons

Before beginning;

- Set your autoloader properly or use [composer](//getcomposer.org)
- Use PHP >= 7.0.0
- Handle each action in `try/catch` blocks
- On README, `dump` means `var_dump`

Notice: See Graph Commons's official documents [here](//graphcommons.github.io/api-v1/) before using this library.

## Installation
```bash
# composer
~$ composer require qeremy/graphcommons-php
```

```js
// composer.json
{"require": {"qeremy/graphcommons-php": "dev-master"}}
```

```php
// manual, after cloning to /path/to/GraphCommons
$autoload = require('/path/to/GraphCommons/Autoload.php');
$autoload->register();
```

## Configuration
Configuration is optional but you can provide all these options;
```php
// dump whole stream while requests
$config['debug'] = false;
// stream blocking
$config['blocking'] = true;
// timeout for read
$config['timeout_read'] = 5;
// timeout for connection
$config['timeout_connection'] = 5;
```

## Usage
```php
use GraphCommons\GraphCommons;
use GraphCommons\Graph\Graph;
use GraphCommons\Graph\Signal;
use GraphCommons\Graph\SignalCollection;

// init gc object
$gc = new GraphCommons('<YOUR API KEY>', $config=[]);
```

##### Check API Status
`GET https://graphcommons.com/api/v1/status`

```php
dump $gc->api->status(): array
```

##### Get a Graph

Notice: You can see each graph data as JSON requesting `https://graphcommons.com/graphs/<GRAPH ID>.json`.

`GET https://graphscommons.com/api/v1/graphs/:id`

```php
$graph = $gc->api->getGraph('<GRAPH ID>'): Graph

dump $graph->id: string
dump $graph->image->path: string
dump $graph->license->type: string
dump $graph->layout->springLength: int

// iteration over users, nodes, edges, nodeTypes, edgeTypes
foreach ($graph->users as $user) {
    print $user->id ."\n";
}
```

##### Add a New Graph
`POST https://graphcommons.com/api/v1/graphs`

```php
$graph = $gc->api->addGraph((function() {
    $graph = new Graph();
    $graph->setName('Person Graph');
    $graph->setDescription('The Person Graph!');
    $graph->setStatus(Graph::STATUS_DRAFT);
    $graph->setSignals(SignalCollection::fromArray(array(
        array(
            'action'        => Signal::NODE_CREATE,
            'parameters'    => array(
                'name'      => 'Ahmet',
                'type'      => 'Person')),
        array(
            'action'        => Signal::EDGE_CREATE,
            'parameters'    => array(
                'from_name' => 'Ahmet',
                'from_type' => 'Person',
                'to_name'   => 'Burak',
                'to_type'   => 'Person',
                'name'      => 'COLLABORATED',
                'weight'    => 2)),
    )));
    return $graph;
})()): Graph
```

##### Add a New Graph Signal
`PUT https://graphcommons.com/api/v1/graphs/:id/add`

```php
$graph = $gc->api->addGraphSignal(
    '<GRAPH ID>', SignalCollection::fromArray(array(
        array(
            'action'        => Signal::EDGE_CREATE,
            'parameters'    => array(
                'from_name' => 'Ahmet',
                'from_type' => 'Person',
                'to_name'   => 'Fatih',
                'to_type'   => 'Person',
                'name'      => 'COLLABORATED',
                'weight'    => 2,
            ),
        ),
))): Graph
```

##### Get a Node
`GET https://graphcommons.com/api/v1/nodes/:id`

```php
$graphNode = $gc->api->getNode('<NODE ID>'): GraphNode
```

##### Get (search) all Nodes
`GET https://graphcommons.com/api/v1/nodes/search`

```php
$graphNodes = $gc->api->getNodes(array(
    'query' => 'kerem',
    'limit' => 1,
)): GraphNodes
```

## Error Handling
```php
try {
    $gc->api->getGraph('nö!');
} catch (\Throwable $e) {
    // 404
    print $e->getCode() ."\n";
    // API error: code(404) message(Graph not found)
    print $e->getMessage() ."\n";

    // print original response status
    print $gc->client->response->getStatus() ."\n";
    // print original response body
    print $gc->client->response->getBody() ."\n";
}
```
