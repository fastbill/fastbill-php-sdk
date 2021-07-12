#!/usr/bin/env bash
#DESCRIPTION: execute phpunit

./tools/php-cs-fixer fix --config=.php-cs --dry-run

INCLUDE: ./../../common/actions/quality.sh

./vendor/bin/phpunit --stop-on-failure --stop-on-error