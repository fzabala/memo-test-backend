# MemoTest (backend)

This is the well-known "memo" game. This project only contains the backend, to run it you will need the frontend

### The frontend repo
https://github.com/fzabala/memo-test-frontend

### Prerequisites
1. Git (you can find it here: https://git-scm.com/)
2. Docker (just follow the instructions from here: https://www.docker.com/)
3. PHP (here's a guide you can follow https://www.php.net/manual/es/install.php)
   1. This project uses laravel, so here's the requirements https://laravel.com/docs/11.x/deployment#server-requirements
4. Composer (you can follow these steps https://getcomposer.org/download/)

### How to run it?
1. Open a terminal and clone this repo using `git clone https://github.com/fzabala/memo-test-backend`
1. Navigate to the project folder `cd memo-test-backend`
1. Create your `.env` file based on `env.example` by running `cp .env.example .env`
   1. Setup the DB_* variables
   1. You can use these values
        ```
        DB_CONNECTION=mysql
        DB_HOST=mysql
        DB_PORT=3306
        DB_DATABASE=laravel
        DB_USERNAME=sail
        DB_PASSWORD=password
        ```
    1. Setup the REDIS_* variables
        ```
        REDIS_CLIENT=phpredis
        REDIS_HOST=redis    
        REDIS_PASSWORD=null
        REDIS_PORT=6379
        ```
    1. Setup the MAIL_* variables
        ```
        MAIL_MAILER=smtp
        MAIL_HOST=mailpit
        MAIL_PORT=1025
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS="hello@example.com"
        MAIL_FROM_NAME="${APP_NAME}"
        ```
1. Install the dependencies `composer install`
1. Run the project with `./vendor/bin/sail build`
1. Run the project with `./vendor/bin/sail up`

Open a new terminal and then
1. Generate app key with `php artisan key:generate`
1. Run the required migrations `./vendor/bin/sail artisan migrate`
1. Run the required seed `./vendor/bin/sail artisan db:seed`
1. Link storage `./vendor/bin/sail artisan storage:link`

### Troubleshooting

#### If you receive an error while running `./vendor/bin/sail up`

`Error starting userland proxy: listen tcp4 0.0.0.0:6379: bind: address already in use`

Check if ports are available in your environment

These are the port we're using
1. mysql: 3306
1. redis: 6379
1. meilisearch: 7700
1. mailpit: 1025

You can check it by running `sudo lsof -t -i :<PORT_NUMBER>`

If you want to use these ports you should kill the process or stop the service

#### Cannot access the images?
1. Check if `public/storage` symlink exists and it's connected to `storage/app/public`
   1. In the project folder, you can run `ls -la public/storage` and see the output
1. You may need to change the permissions of the `storage` folder to 775

#### There is no existing directory at /storage/logs and its not buildable: Permission denied
Try these commands

`./vendor/bin/sail artisan route:clear`

`./vendor/bin/sail artisan config:clear`

`./vendor/bin/sail artisan cache:clear`
