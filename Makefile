i:
	composer install && npm i && make dbs

dbs:
	php artisan migrate:fresh --seed
