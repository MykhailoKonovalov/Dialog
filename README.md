#Package for logging in php.

## Basic Usage

```php
<?php

use Dialog\Logger;

$log = new Logger('LogName', "path_to_log_file.log");
$log->warning('Foo');
$log->error("Bar", ['foo'=>'bar']);
```
