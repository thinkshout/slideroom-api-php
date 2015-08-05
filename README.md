# SlideRoom SDK for PHP

PHP SDK for SlideRoom API V2 https://api.slideroom.com/

# Example

```php
<?php
require __DIR__ . '/vendor/autoload.php';

$slideroom = new SlideRoomClient('A1B2C3D4F5G6H7J8K9L0A1B2C3D4F5G6H7J8K9L0A1B2C3D4F5G6H7J8K9L0');

$application_results = $slideroom->application->requestExport(array(
  'format' => 'csv',
  'tab.export' => 'My Custom Export'
));

print_r($application_results);

$export_results = $slideroom->export->get($application_results['token']);

print_r($export_results);
```

```
Array
(
    [message] => Export request accepted. GET export endpoint with token to check back in on this export.
    [submissions] => 1
    [token] => 12345
)
```

```
Array
(
    [status] => Pending
    [total_files] => 1
    [completed_files] => 0
    [file_urls] => Array
        (
        )
)
```
