<?php

Kirby::plugin('getkirby/staticache', [
    'hooks' => [
        'route:after' => function ($result, $path) {
            if (is_a($result, 'Kirby\Cms\Page') === true) {
                $file = $this->cache('pages')->root() . '/' . ltrim($path . '/index.html', '/');
                F::write($file, $result->render());
            }
        }
    ]
]);
