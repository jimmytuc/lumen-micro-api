# Lumen Micro API

A starter template to develop micro API with Lumen 8.

### Configuration

- Edit `.env` file for environment variables.
- Edit the files in `config` directory for application configuration.

### Installation

- Clone the repo: `git clone git@github.com:jimmytuc/lumen-micro-api.git`
- Then: `cd lumen-micro-api`
- Start the development server with `make up`.
- When you have changed `composer.json` or want to install extra dependencies: `make composer-install` | `make composer-update`
- Migrating database schema: `make migrate`, error? `make migrate-revert`

The nginx server will be available at 8080 port for serving request
### Debugging

- SSH into the app container: `make ssh`
- Generate new key: `make ssh`, then `php artisan key:generate`

### Unit testing

- Run some unit tests: `make test`
- Run `make` to see available commands.

### Exit

- Exit from app container with `CTRL+C` or `exit`.

### Health-checking

```shell
curl http://127.0.0.1:8080
```

should return
```shell
{
  "name":"Lumen",
  "version":"0.0.1",
  "framework":"Lumen (8.2.4) (Laravel Components ^8.0)",
  "environment":"local",
  "debug_mode":false,
  "timestamp":"2021-11-01 01:25:39","timezone":"UTC"
}
```
if the service is up and running

### Create new wager

- `total_wager_value` must be specified as a positive integer above 0
- `odds` must be specified as a positive integer above 0
- `selling_percentage` must be specified as an integer between 1 and 100
- `selling_price` must be specified as a positive decimal value to two decimal places, it is a monetary value
- `selling_price` must be greater than total_wager_value * (selling_percentage / 100)

For an example:

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

- `buying_price` should be an positive decimal value
- `buying_price` must be lesser or equal to `current_selling_price` of the `wager_id`
- A successful purchase should update the wager fields `current_selling_price`, `percentage_sold`, `amount_sold`

For an example:
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

Specifying the page and number of results you want to return (but not more than 50, otherwise it will keep the maximum results at 50):

```shell
curl --request GET 'http://127.0.0.1:8080/wagers?page=<page>&limit=<limit>' \
    --header 'Content-Type: application/json'
```

- `<page>`: the current page (offset)
- `<limit>`: the number of records to be returned
