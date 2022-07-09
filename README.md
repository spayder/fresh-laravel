# Fresh Laravel installation, ready to start coding

### How to run the project on local environment (docker dependency):
1. Build and run the project

   ``docker-compose up -d --build``
2. Install framework dependencies

   ``docker-compose run --rm composer install``
3. Generate secret key

   ``docker-compose run --rm php php artisan key:generate``
4. copy .env.example .env in ``src`` directory
5. In .env change the following params:
    1. ``DB_DATABASE=fresh``
    2. ``DB_USERNAME=fresh``
    3. ``DB_PASSWORD=fresh_secret_password``
    4. ``DB_HOST=db``

6. At this stage we need to create the database. For that just run:
``docker-compose run --rm php php artisan migrate``

The application by default is listening on port ``8085`` so the url will be: ``localhost:8085``

To run the tests, just execute:
``docker-compose run --rm php ./vendor/bin/phpunit``

To stop all containers run:
``docker-compose stop``