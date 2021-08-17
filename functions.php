<?php

use Veloce\Enqueue;
use Veloce\TemplateRedirect;
use Veloce\Theme;

define('VELOCE_START', microtime(true));

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

new Enqueue($app);
new TemplateRedirect($app);
new Theme($app);
