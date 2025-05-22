## How to start
- copy .env.example to .env
- `docker-compose build`
- `docker-compose run --rm php-cli php artisan key:generate`
- `docker-compose run --rm php-cli composer install`
- `docker-compose up -d`
- `docker-compose run --rm php-cli php artisan migrate:fresh --seed`
- open http://localhost/

### Enter to php-cli
- docker-compose run php-cli sh

