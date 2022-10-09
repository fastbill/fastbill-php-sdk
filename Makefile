MAKEFLAGS += --warn-undefined-variables
MAKEFLAGS += --no-builtin-rules

.PHONY: help
.PHONY: help
help:       ## Shows the help
help:
	@printf "\033[33mUsage:\033[0m\n  make TARGET\n\n\033[32m#\n# Commands\n#---------------------------------------------------------------------------\033[0m\n"
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//' | awk 'BEGIN {FS = ":"}; {printf "\033[33m%s:\033[0m%s\n", $$1, $$2}'


.PHONY: docker-up
docker-up:  ## build the configurator-ram-service and start it
docker-up:
	docker compose up

.PHONY: docker-ssh
docker-ssh: ## creates an ssh connection to the configurator-ram-service
docker-ssh:
	docker-compose exec sdk bash -l

.PHONY: docker init
import:     ## import and initialize the data into the docker container
import:
	docker cp ./ fastbill_sdk:/var/www/html/public
	docker exec fastbill_sdk bash -c "sudo chown www-data:www-data /var/www -R"
	docker exec fastbill_sdk bash -c "cd /var/www/html/public && composer install"



.PHONY: docker-quality
docker-quality:     ## executes all quality scripts in the running docker container
docker-quality:
	docker exec fastbill_sdk bash -c "cd /var/www/html/public && PHP_CS_FIXER_IGNORE_ENV=true ./tools/php-cs-fixer fix --config=.php-cs-fixer.php"
	docker exec fastbill_sdk bash -c "cd /var/www/html/public && ./tools/phpstan analyse -l 5 ./src/"
	docker exec fastbill_sdk bash -c "cd /var/www/html/public && ./vendor/bin/phpunit --stop-on-failure --stop-on-error --coverage-html=./build/artifacts/html-coverage"


.PHONY: docker-cs
docker-cs:     ## executes code style scripts in the running docker container
docker-cs:
	docker exec fastbill_sdk bash -c "cd /var/www/html/public && PHP_CS_FIXER_IGNORE_ENV=true ./tools/php-cs-fixer fix --config=.php-cs-fixer.php"

.PHONY: docker-phpstan
docker-phpstan:     ## executes phpstan scripts in the running docker container
docker-phpstan:
	docker exec fastbill_sdk bash -c "cd /var/www/html/public && ./tools/phpstan analyse -l 5 ./src/"

.PHONY: docker-unit
docker-unit:     ## executes php unit in the running docker container
docker-unit:
	docker exec fastbill_sdk bash -c "cd /var/www/html/public && ./vendor/bin/phpunit --stop-on-failure --stop-on-error --coverage-html=./build/artifacts/html-coverage"



