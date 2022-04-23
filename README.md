> Changes to the original staticache from Bastian Allgeier

# Kirby HTCache Plugin

A twist on https://github.com/getkirby/staticache that enables content representations. Built for apache, works only on apache (therefore can't be merged into staticache).

The basic idea is to save the content into a format agnostic "cache.dat" file instead of "index.html", then serve it with the correct headers by adding an appropriate ".htaccess" file. 

## 🚨 Experimental

This plugin is an experiment built on an experiment. 

## Installation

### Download

Download and copy this repository to `/site/plugins/htcache`.

### Composer

Currently not available. 
<!--
```
composer require rasteiner/htcache
```
-->

### Git submodule

```
git submodule add https://github.com/rasteiner/htcache.git site/plugins/htcache
```

## Setup

### Cache configuration

HTcache is just a cache driver that can be activated for the page cache:

```php
// /site/config/config.php

return [
  'cache' => [
    'pages' => [
      'active' => true,
      'type' => 'htcache'
    ]
  ]
];
```

You can also use the cache ignore rules to skip pages that should not be cached:
https://getkirby.com/docs/guide/cache#caching-pages

```php
// /site/config/config.php

return [
  'cache' => [
    'pages' => [
      'active' => true,
      'type' => 'static',
      'ignore' => function ($page) {
        return $page->template()->name() === 'blog';
      }
    ]
  ]
];
```

Kirby will automatically purge the cache when changes are made in the Panel.

### htaccess rules

Add the following lines to your Kirby htaccess file, directly after the RewriteBase rule.

```aconf
# htcache
RewriteCond %{ENV:CACHE} !disable [NC]
RewriteCond %{DOCUMENT_ROOT}/static/%{REQUEST_URI}/cache.dat -f [NC]
RewriteRule ^(.*) %{DOCUMENT_ROOT}/static/%{REQUEST_URI}/cache.dat [L]
```

## License

MIT

## Credits

- [Bastian Allgeier](https://github.com/getkirby/staticache) - the initial idea and most of the code / documentation
- Roman Steiner - The changes above