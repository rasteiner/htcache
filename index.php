<?php

load([
    'Kirby\Cache\HTCache' => __DIR__ . '/src/HTCache.php'
]);

Kirby::plugin('rasteiner/htcache', [
    'cacheTypes' => [
        'htcache' => 'rasteiner\Cache\HTCache'
    ]
]);
