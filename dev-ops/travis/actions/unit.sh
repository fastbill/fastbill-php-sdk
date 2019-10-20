#!/usr/bin/env bash
#DESCRIPTION: execute phpunit

USERNAME=$USERNAME APIKEY=$APIKEY ./vendor/bin/phpunit --stop-on-failure --stop-on-error --coverage-html=./build/artifacts/html-coverage