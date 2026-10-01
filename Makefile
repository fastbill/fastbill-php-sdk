MAKEFLAGS += --warn-undefined-variables
MAKEFLAGS += --no-builtin-rules

.PHONY: help
help:       ## Shows the help
help:
	@printf "\033[33mUsage:\033[0m\n  make TARGET\n\n\033[32m#\n# Commands\n#---------------------------------------------------------------------------\033[0m\n"
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//' | awk 'BEGIN {FS = ":"}; {printf "\033[33m%s:\033[0m%s\n", $$1, $$2}'


.PHONY: ddev-up
ddev-up:    ## starts the ddev project
ddev-up:
	ddev start

.PHONY: ddev-down
ddev-down:  ## stops the ddev project
ddev-down:
	ddev stop

.PHONY: ddev-ssh
ddev-ssh:   ## opens a shell in the ddev web container
ddev-ssh:
	ddev ssh

.PHONY: ddev-install
ddev-install: ## installs the composer dependencies in the ddev web container
ddev-install:
	ddev composer install


.PHONY: ddev-quality
ddev-quality: ## executes all quality scripts in the ddev web container
ddev-quality: ddev-cs ddev-phpstan ddev-unit

.PHONY: ddev-cs
ddev-cs:    ## executes code style scripts in the ddev web container
ddev-cs:
	ddev exec "PHP_CS_FIXER_IGNORE_ENV=true ./tools/php-cs-fixer fix --config=.php-cs-fixer.php"

.PHONY: ddev-phpstan
ddev-phpstan: ## executes phpstan in the ddev web container
ddev-phpstan:
	ddev exec "./tools/phpstan analyse -l 5 ./src/"

.PHONY: ddev-unit
ddev-unit:  ## executes phpunit in the ddev web container
ddev-unit:
	ddev exec "./vendor/bin/phpunit --stop-on-failure --stop-on-error"

.PHONY: ddev-coverage
ddev-coverage: ## executes phpunit with html coverage (temporarily enables xdebug)
ddev-coverage:
	ddev xdebug on
	ddev exec "XDEBUG_MODE=coverage ./vendor/bin/phpunit --stop-on-failure --stop-on-error --coverage-html=./build/artifacts/html-coverage"; status=$$?; ddev xdebug off; exit $$status
