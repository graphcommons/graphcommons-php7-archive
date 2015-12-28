Graph Commons is a collaborative 'network mapping' platform and a knowledge base of relationships. You can map relationships at scale and unfold the mystery about complex issues that impact you and your community.

See more about [here](//graphcommons.com/about).

## GraphCommons

Before beginning;

- Set your autoloader properly or use composer
- Use PHP >= 7.0.0
- Handle each action in try/catch blocks
- On README, `dump` means `var_dump`

Notice: See Graph Commons's official documents [here](//graphcommons.github.io/api-v1/) before using this library.

## Install
```php
// composer
{"require": {"qeremy/graphcommons-php": "dev-master"}}

// manual after cloning to /path/to/GraphCommons
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
define('API_KEY', '<YOUR API KEY>');

use GraphCommons\GraphCommons;
use GraphCommons\Graph\Graph;
use GraphCommons\Graph\Signal;
use GraphCommons\Graph\SignalCollection;

// init gc object
$gc = new GraphCommons(API_KEY, $config);
```

##### Check API Status
```php
dump $gc->api->status(): array
```

##### Get a Graph
```php
dump $gc->api->getGraph('<GRAPH ID>'): array
```

##### Get a New Graph
```php
$data = $gc->api->addGraph((function() {
    $graph = new Graph();
    $graph->setName('Person Graph');
    $graph->setDescription('The Person Graph!');
    $graph->setStatus(Graph::STATUS_DRAFT);
    $graph->setSignals(SignalCollection::fromArray(array(
        array(
            'action'        => Signal::NODE_CREATE,
            'parameters'    => array(
                'name'      => 'Ahmet',
                'type'      => 'Person',
            ),
        ),
        array(
            'action'        => Signal::EDGE_CREATE,
            'parameters'    => array(
                'from_name' => 'Ahmet',
                'from_type' => 'Person',
                'to_name'   => 'Burak',
                'to_type'   => 'Person',
                'name'      => 'COLLABORATED',
                'weight'    => 2,
            ),
        ),
    )));
    return $graph;
})());
```
