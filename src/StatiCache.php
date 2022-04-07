<?php

namespace Kirby\Cache;

use Kirby\Filesystem\F;
use Kirby\Http\Url;

class StatiCache extends FileCache
{

    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->root = kirby()->root('cache') . '/static';
    }

    public function file(string $key): string
    {
        $path = kirby()->path();

        // home
        if (empty($path) === true) {
            return $this->root . '/index.html';
        }

        $extension = F::extension($path);

        // regular html pages
        if (empty($extension) === true) {
            return $this->root . '/' . $path .  '/index.html';
        }

        // content representation file
        return $this->root . '/' . $path;
    }

    public function retrieve(string $key)
    {
        return F::read($this->file($key));
    }

    public function set(string $key, $value, int $minutes = 0): bool
    {
        return true;
        return F::write($this->file($key), $value['html']);
    }

}
