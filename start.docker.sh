#!/usr/bin/env bash

# startup
docker-compose up -d

sleep 1

# make config
docker-compose run --rm app sh -c "cp .env.example .env"

sleep 0.5

# make migrate
docker-compose run --rm app sh -c "php artisan migrate"

# gracefully shutdown
exit 0
