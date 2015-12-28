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
