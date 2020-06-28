# Slim Cats API
API to search CAT's information

## Prerequisites
[Docker-composer](https://docs.docker.com/compose/install/)

## Configuration
Docker UP

```bash
docker-composer up -d
```

Access html folder
```bash
$ cd html
```

Install dependencies
```bash
$ composer install
```

Migrations
```bash
$ vendor/davedevelopment/phpmig/bin/phpmig migrate
```

## Test 
PHPunit test
```bash
$ vendor/phpunit/phpunit/phpunit test
```

## Documentation
Swagger Documentation

Access [http://localhost/swagger/](http://localhost/swagger/)
