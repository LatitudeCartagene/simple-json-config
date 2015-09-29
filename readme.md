# Simple JSON config

```php
$config = new Config('config.json');

$host   = $config->get("host");
$port   = $config->get("port");

// Nested keys
$env    = $config->get("environment.dev");
```

### Autoload

Use composer PSR-4 autoload

```
$ composer dumpautoload
```

Then just require the autoloader

```php
<?php

require_once('vendor/autoload.php');
```
