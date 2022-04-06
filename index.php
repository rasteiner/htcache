<?php

Kirby::plugin('getkirby/staticache', [
    'hooks' => [
        'route:after' => function ($result, $path) {
            // check if it's actually a page request and not some custom route, 
            // a panel request or anything else.
            if (is_a($result, 'Kirby\Cms\Page') === true) {
                // store the file result in DOCUMENT_ROOT/static/some/path/index.html
                $file = $this->root('index') . '/static/' . ltrim($path . '/index.html', '/');

                // add <!-- static --> to the HTML file just so we can use view-source 
                // to check if it worked. 
                F::write($file, $result->render() . ' <!-- static -->');
            }
        }
    ]
]);
