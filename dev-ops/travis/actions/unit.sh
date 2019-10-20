#!/usr/bin/env bash
#DESCRIPTION: execute phpunit

./tools/php-cs-fixer fix --config=.php-cs --dry-run

INCLUDE: ./../../common/actions/quality.sh

USERNAME=$USERNAME APIKEY=$APIKEY ./vendor/bin/phpunit --stop-on-failure --stop-on-error --coverage-html=./build/artifacts/html-coverage