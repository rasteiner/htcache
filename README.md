# Kirby Staticache Plugin

Static site performance on demand

## 🚨 Experimental

This plugin is still an experiment. The first results are very promising but it needs to be tested on more servers and has a couple open todos:

- [ ] Hooks to automatically flush the cache when content is updated via the Panel
- [ ] Add options to ignore pages from caching
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
