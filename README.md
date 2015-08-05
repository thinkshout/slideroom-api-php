# SlideRoom SDK for PHP

PHP SDK for SlideRoom API V2 https://api.slideroom.com/

# Install

```sh
composer install
```

# Example

```php
<?php
require __DIR__ . '/vendor/autoload.php';

$slideroom = new SlideRoomClient('A1B2C3D4F5G6H7J8K9L0A1B2C3D4F5G6H7J8K9L0A1B2C3D4F5G6H7J8K9L0');
$results = $slideroom->export->get('123456');
print_r($results);
```

```
Array
(
    [status] => Complete
    ...
)
```