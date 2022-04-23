<?php

use Kirby\Cms\App;

load([
    'rasteiner\Cache\HTCache' => __DIR__ . '/src/HTCache.php'
]);

App::plugin('rasteiner/htcache', [
    'cacheTypes' => [
        'htcache' => 'rasteiner\Cache\HTCache'
    ]
]);
