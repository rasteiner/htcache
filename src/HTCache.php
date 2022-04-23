<?php

namespace rasteiner\Cache;

use Kirby\Cache\FileCache;
use Kirby\Filesystem\F;

class HTCache extends FileCache
{
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->root = kirby()->root('index') . '/static';
    }

    public function file(string $key): string
    {
        $path      = dirname($key);
        $name      = F::name($key);
        $extension = F::extension($key);

        if ($name === 'home') {
            return $this->root . '/cache.dat';
        }

        if($extension !== 'html') {
            $name = $name . '.' . $extension;
        }

        return $this->root . '/' . $path . '/' . $name . '/cache.dat';
    }

    public function meta(string $key): string
    {
        $path      = dirname($key);
        $name      = F::name($key);
        $extension = F::extension($key);

        if ($name === 'home') {
            return $this->root . '/.htaccess';
        }

        if($extension !== 'html') {
            $name = $name . '.' . $extension;
        }

        return $this->root . '/' . $path . '/' . $name . '/.htaccess';
    }

    public function metadata($value): string
    {
        $headers = $value['response']['headers'];

        foreach(headers_list() as $header) {
            $parts = explode(':', $header, 2);
            $headers[$parts[0]] = $parts[1];
        }

        //whitelist only the headers we want to cache
        $headers = array_intersect_key($headers, array_flip([
            'Content-Type',
            'Content-Disposition',
        ]));

        $headers['X-Kirby-Cache'] = 'static';

        $mod_headers = "<IfModule mod_headers.c>\n";
        foreach($headers as $key => $value) {
            $value = str_replace(["\r", "\n"], ' ', $value);
            $value = str_replace('"', '\"', $value);
            $value = trim($value);
            $mod_headers .= "Header set $key \"$value\"\n";
        }
        $mod_headers .= "</IfModule>\n";

        return $mod_headers;
    }

    public function retrieve(string $key)
    {
        return F::read($this->file($key));
    }

    public function set(string $key, $value, int $minutes = 0): bool
    {
        return F::write($this->file($key), $value['html']) && F::write($this->meta($key), $this->metadata($value));
    }
}
