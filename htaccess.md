## htaccess rules

RewriteCond %{DOCUMENT_ROOT}/site/cache/%{HTTP_HOST}/pages%{REQUEST_URI}/index.html -f [NC]
RewriteRule ^ site/cache/%{HTTP_HOST}/pages%{REQUEST_URI}/index.html [L]
