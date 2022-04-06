# Kirby Staticache Plugin

Static site performance on demand

## 🚨 Experimental

This plugin is still an experiment. The first results are very promising but it needs to be tested on more servers and has a couple open todos:

- [x] Hooks to automatically flush the cache when content is updated via the Panel
- [x] Add options to ignore pages from caching
- [ ] Nginx config example
- [ ] Caddy config example
- [ ] Publish on Packagist to be installable via composer

## Installation

### Download

Download and copy this repository to `/site/plugins/staticache`.

### Git submodule

```
git submodule add https://github.com/getkirby/staticache.git site/plugins/staticache
```

## Setup

### Cache configuration

Staticache is just a cache driver that can be activated for the page cache:

```php
// /site/config/config.php

return [
  'cache' => [
    'pages' => [
      'active' => true,
      'type' => 'static'
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

```
RewriteCond %{DOCUMENT_ROOT}/static/%{REQUEST_URI}/index.html -f [NC]
RewriteRule ^(.*) %{DOCUMENT_ROOT}/static/%{REQUEST_URI}/index.html [L]
```

## License

MIT

## Credits

- [Bastian Allgeier](https://getkirby.com/plugins/getkirby)
