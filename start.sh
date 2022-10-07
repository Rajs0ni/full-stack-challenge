#!/bin/bash
fuser -k 8091/tcp
fuser -k 8093/tcp

yarn install;
pushd panel/; ln -s build.env.local .env; yarn install ; popd;
pushd laravel-api/; ln -s .env.local .env; composer install; php artisan migrate ; php artisan optimize; popd;
(cd laravel-api; php -S  localhost:8091 -t public & cd ../panel ; yarn serve --port  8093 --host localhost & wait)

