# Lumen Micro API

A starter template to develop micro API with Lumen 8.

### Configuration

- Edit `.env` file for environment variables.
- Edit the files in `config` directory for application configuration.

### Installation

- Clone the repo: `git clone git@github.com:jimmytuc/lumen-micro-api.git`
- Then: `cd lumen-micro-api`
- Start the development server with `make up`.
- Migrating database schema: `make migrate`, error? `make migrate-rollback`

### Debugging

- SSH into the app container: `make ssh`
- Generate new key: `make ssh`, then `php artisan key:generate`

### Unit testing

- Run some unit tests: `make test`
- Run `make` to see available commands.

### Exit

- Exit from app container with `CTRL+C` or `exit`.

### Create new wager

```shell
curl --request POST 'http://127.0.0.1:8080/wagers' \
    --header 'Content-Type: application/json' \
    --data-raw '{
        "total_wager_value": 100,
        "odds": 10,
        "selling_percentage": 50,
        "selling_price": 50.25
    }'
```

### Buying

- `<wager_id>`: Specify your correct wager id

```shell
curl --request POST 'http://127.0.0.1:8080/buy/<wager_id>' \
    --header 'Content-Type: application/json' \
    --data-raw '{
        "buying_price": 20.255555
    }'
```

### List wagers

```shell
curl --request GET 'http://127.0.0.1:8080/wagers' \
    --header 'Content-Type: application/json'
```

Default returns 10 results and the first page.
Specifying the page and number of results you want to return (but not more than 50):

```shell
curl --request GET 'http://127.0.0.1:8080/wagers?page=<page>&limit=<limit>' \
    --header 'Content-Type: application/json'
```

- `<page>`: the current page (offset)
- `<limit>`: the number of records to be returned
