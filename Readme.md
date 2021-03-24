## About
Mini CRM, this demo project which manages a CRUD between clients and transactions.
It also contains [Github Actions](https://docs.github.com/en/actions/learn-github-actions) with a simple configuration for [CI/CD](https://en.wikipedia.org/wiki/CI/CD) in [run-tests.yml](https://github.com/caritoz/mini-crm/blob/master/.github/workflows/run-tests.yml).

## Requirements
* [Docker](https://docs.docker.com/)
* [Composer](http://getcomposer.org)
* [Git](http://git-scm.com)
* [PHP >= 7.1](http://php.net)
* [Laravel v8 Support](https://laravel.com/docs/8.x)
* [PHPUnit v9](https://phpunit.readthedocs.io/en/9.5/index.html)
* [BootstrapVue v2](https://bootstrap-vue.org/docs)
* PHP Extensions:
    -  PHP >= 7.4
    -  BCMath PHP Extension
    -  Ctype PHP Extension
    -  Fileinfo PHP extension
    -  JSON PHP Extension
    -  Mbstring PHP Extension
    -  OpenSSL PHP Extension
    -  PDO PHP Extension
    -  Tokenizer PHP Extension
    -  XML PHP Extension
    
### Installation

Execute this command to install the project:

```bash
$ composer update
```

#### Usage
1. Clone the project repo and checkout to development branch
```
    $ git clone https://github.com/caritoz/mini-crm.git
    
    $ cd mini-crm        
```    

2. To start a development environment for the first time, run
```
    $ sudo docker-compose up -d --build
```    
3. Open a terminal and composer install
```
    ## connect to docker app bash
    $ docker-compose exec api bash
    
    ## composer may ask for GitHub credentials the first time
    $ composer install --no-plugins --no-scripts

    ## Install other dependencies and compilation
    $ npm install & npm run dev

    ## Install migrations and seeds
    $ php artisan migrate --seed

    ## create the encryption keys needed to generate secure access tokens
    $ php artisan passport:install

    ## symbolic link by Images
    $ php artisan storage:link
  
```
### PHPUnit tests in Laravel
````
## you can migrate the database to sqlite db for testing
$ touch database.sqlite
$ php artisan migrate --seed --env=testing

## Run tests
$ ./vendor/bin/phpunit --testdox

````


### Configuration

1. Add "127.0.0.1 {{HOST}}" to your hosts file
2. Access https://{{HOST}}/
3. Environments API for file .dockerenv

```dockerfile
DOCKER_PHP_SERVICE=php-fpm
DOCKER_PHP_SERVICE_PORT=9000
DOCKER_DATABASE_SERVICE=database

SERVER_NAME={{SERVER_NAME}}

```php

#set up app
APPLICATION_ID={{APPLICATION_ID}}
APP_NAME={{APP_NAME}}
APP_ENV={{APP_ENV}}
APP_KEY={{APP_KEY}}
APP_DEBUG=true
APP_URL=http://localhost
ENABLE_DEBUGGING=true
ENABLE_MEMCACHED=true

# set up server email
SMTP_HOST={{SMTP_HOST}}
SMTP_PORT={{SMTP_PORT}}
SMTP_AUTH={{SMTP_AUTH}}
SMTP_USERNAME={{SMTP_USERNAME}}
SMTP_PASSWORD={{SMTP_PASSWORD}}

#set up database
DATABASE_HOST={{DATABASE_HOST}}
DATABASE_PORT={{DATABASE_PORT}}
DATABASE_NAME={{DATABASE_NAME}}
DATABASE_USERNAME={{DATABASE_USERNAME}}
DATABASE_PASSWORD={{DATABASE_PASSWORD}}

# set up others
LOG_CHANNEL=daily

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=cookie
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
