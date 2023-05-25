## Rewards Backend

### Requirements
- PHP Version:  8.2
- composer Version: 2.5

### Setup Project
Please run these below commands:
```shell
docker-compose up -d

docker-compose exec app bash

cp .env.example .env

php artisan key:generate
```