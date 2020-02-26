test:
	docker-compose exec app php ./vendor/bin/phpunit

dry_test:
	docker-compose up -d nginx
	docker-compose exec app php artisan migrate:fresh --seed
	docker-compose exec app php ./vendor/bin/phpunit
	docker-compose down

init:
	docker-compose exec app php artisan migrate:fresh --seed

up:
	docker-compose up -d nginx

ps:
	docker-compose ps

down:
	docker-compose stop

exec:
	docker-compose exec app sh

init:
	docker-compose exec app php artisan migrate:fresh --seed

linter:
	docker run --rm -v "$(CURDIR)":/workdir jakzal/phpqa:1.24-alpine sh /workdir/bin/entrypoint-linter.sh