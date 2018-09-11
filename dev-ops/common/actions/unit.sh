#!/usr/bin/env bash
#DESCRIPTION: execute phpunit

./vendor/bin/phpunit --stop-on-failure --stop-on-error --coverage-html=./build/artifacts/html-coverage