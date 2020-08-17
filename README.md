# BoatApp

There is two main folders :

- BoatApp : contains the project files
- laradock : contains docker config files

1. Download the repository
2. Add both .env received by email in BoatApp/BoatApp and BoatApp/laravel (more precision in the email)
3. Open BoatApp/laravel/.env
  - find the COMPOSE_PATH_SEPARATOR variable
  - if you are deploying on windows the value must be ";", otherwise, ":"
4. Open a terminal in BoatApp/laravel/, run `docker-compose up -d apache2 mysql`. This will create and configure the containers in order to run the project
5. Initialize the project, connect to the container terminal: `docker exec -it boatapp_workspace_1 bash` and run all those commands:
```
composer install
npm install
npm run dev
php artisan migrate
php artisan passport:install
php artisan db:seed
```

The project is ready !

Open your browser, connect to your localohst and enjoy !
