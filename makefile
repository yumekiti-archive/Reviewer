UID := $(shell id -u)
GID := $(shell id -g)
USER := $(UID):$(GID)
dc := user=$(USER) docker-compose -f ./docker/docker-compose.yml

.PHONY: init
init:
	$(dc) up -d --build
	bash ./docker/php/sql.sh
	$(dc) exec php /bin/bash -c "composer install"
	$(dc) exec php /bin/bash -c "cp .env.example .env"
	$(dc) exec php /bin/bash -c "php artisan key:generate"
	$(dc) exec php /bin/bash -c "php artisan migrate"
	$(dc) exec node /bin/sh -c "npm install && npm run dev"

.PHONY: up
up:
	$(dc) up -d --build
	bash ./docker/php/sql.sh

.PHONY: down
down:
	$(dc) down

.PHONY: restart
restart:
	$(dc) -p lamp restart

.PHONY: rm
rm:
	$(dc) down --rmi all

.PHONY: logs
logs:
	$(dc) logs -f

.PHONY: db
db:
	$(dc) exec db /bin/sh

.PHONY: php
php:
	$(dc) exec php /bin/sh

.PHONY: nginx
nginx:
	$(dc) exec nginx /bin/sh
	
.PHONY: seed
seed:
	$(dc) -f ./docker/docker-compose.yml exec php php artisan db:seed

.PHONY: fresh
fresh:
	$(dc) -f ./docker/docker-compose.yml exec php php artisan migrate:fresh

.PHONY: fresh-seed
fresh-seed:
	$(dc) -f ./docker/docker-compose.yml exec php php artisan migrate:fresh --seed

.PHONY: npm
npm:
	$(dc) exec node /bin/sh -c "npm install && npm run dev"

.PHONY: file-rm
file-rm:
	rm -f ./docker/laravel-echo/laravel-echo-server.lock
	rm -fr ./laravel/node_modules/