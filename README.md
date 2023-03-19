## Boilerplate Lumen - Lumen 9.x REST API


### Installation

 1. Clone this project\
 `git clone https://git@github.com:Bayudiartaa/Boilerplate-Lumen.git`
 2. Cd into your project folder\
 `cd Samanea-BE`
 3. Run all the build images in docker\
 `docker-compose up -d --build`
 3. Install dependencies\
 `docker-compose exec app composer install --ignore-platform-req=ext-zip`\
 4. Copy env file\
 `cp .env.example .env`
 5. Setup your database via .env file \
 `.env`
 6. Migrate database\
 `docker-compose exec app php artisan migrate`
 7. (Optional) Seed the database\
 `docker-compose exec app php artisan db:seed`
 8. Create jwt key\
 `docker-compose exec app php artisan jwt:secret`
 9. Run Unit Test\
 ` docker-compose exec app vendor/bin/phpunit tests/{nameTest.php}`
 ## Serve
 `localhost:80`
 
