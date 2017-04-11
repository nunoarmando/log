# README #

---

**naas/log** is a simple logging class

Installation

Install with [composer](http://getcomposer.org/download)

``` json
{
    "require": {
        "naas/log": "dev-master"
    }
}
```

Example
--------

You need to include the Autoload.php and create a page class.

``` php
require_once __DIR__ . '/library/Autoload.php';

// You may use thru a factory pattern
$log = LogFactory::create();
$log->logIt('Type of log', 'Log message...');
$log->logIt('Type of error', 'Error message...', false);
$log->logIt('Type of error in other file', 'Error message...', false, 'err');

// Or use it by object creation
$log = new Log();
$log->logIt('Type of log', 'Log message...');
$log->logIt('Type of error', 'Error message...', false);
$log->logIt('Type of error in other file', 'Error message...', false, 'err');

// Or use it thru static methods
// TODO: Log::logIt('Type of log', 'Log message...');
// TODO: Log::logIt('Type of error', 'Error message...', false);
// TODO: Log::logIt('Type of error in other file', 'Error message...', false, 'err');

