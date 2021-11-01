#!/usr/bin/env bash

docker-compose up -d

sleep 1

docker-compose run --rm app sh -c "php artisan migrate"

exit 0
