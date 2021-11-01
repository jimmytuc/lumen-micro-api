.PHONY: help

help:
	@echo "\nLumen API Starter - Make\n"
	@echo "\033[4mCommands:\033[0m\n"
	@echo "make [command]\n"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-10s\033[0m %s\n", $$1, $$2}'

up: ## Up all Docker services
	@docker-compose up -d

stop: ## Stop all Docker services
	@docker-compose stop

down: ## Down all Docker services
	@docker-compose down

config: ## Make a configuration for laravel app
	@docker-compose run --rm app sh -c "cp .env.example .env"

migrate: ## Run the migration
	@docker-compose run --rm app sh -c "php artisan migrate"

migrate-revert: ## Rollback the migration
	@docker-compose run --rm app sh -c "php artisan migrate:rollback"

logs: ## Follow logs from Docker service app
	@docker-compose logs -f app

ssh: ## SSH into docker container app
	@docker-compose run --rm app sh

composer: ## SSH into a docker container composer
	@docker run --rm -it -v $(PWD):/app composer:2 sh

composer-install: ## SSH into a docker container composer and install deps
	@docker run --rm -it -v $(PWD):/app composer:2 sh -c "composer install"

composer-update: ## SSH into a docker container composer and update deps version
	@docker run --rm -it -v $(PWD):/app composer:2 sh -c "composer update"

test: ## Run some PHPUnit tests
	@docker-compose run --rm app vendor/bin/phpunit
