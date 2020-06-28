# Slim Cats API
API to search CAT's information

## Prerequisites
[Composer](https://getcomposer.org/) - A Dependency Manager for PHP.

[Docker-composer](https://docs.docker.com/compose/install/) - Compose is a tool for defining and running multi-container Docker applications.


## Configuration
Docker UP

```bash
docker-composer up -d
```

Access html folder
```bash
cd html
```

Install dependencies
```bash
composer install
```

Migrations
```bash
./vendor/bin/phpmig migrate
```

## To test 
PHPunit test
```bash
./vendor/bin/phpunit test
```

## Documentation
Swagger Documentation

Access [http://localhost/swagger/](http://localhost/swagger/)

## Directory Structure 

```
root
└── html
    ├── migrations
    ├── public
    │   └── swagger
    ├── src
    │   ├── Controlles
    │   ├── Models
    │   └── Resources
    ├── swagger
    ├── test
    │   └── integrations
    └── vendor
```
