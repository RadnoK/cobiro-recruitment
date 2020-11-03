# Cobiro Recruitment Task

This is a solution for a task described in the [PHP Task Attachment.pdf](PHP%20Task%20Attachment.pdf).

## Key highlights

* Product "domain" separated from Symfony Application;
* Price kept as [Money](https://moneyphp.org/) implementation;
* Simple [CQRS implementation](src/Cobiro/Common/Application/System);
* Easy replaceable services like [`Calendar`](src/Cobiro/Common/Application/System/Calendar.php). Currently used [Aeon](http://aeon-php.org/) implementation;
* Request validation using Symfony Forms Component;

## Installation

```shell script
$ cp .env .env.local
$ docker-composer up --build --detach
```

After the container is build run this to access it:

```shell script
$ docker exec --interactive --tty cobiro-recruitment_php-fpm_1 sh
```

Once you are in the PHP container you can install dependencies as following:

```shell script
$ composer install
$ bin/console doctrine:migrations:migrate
``` 

## Usage

Once you have Docker up and running, you can interact with the application in two ways

### API

```http request
POST http://127.0.0.1:8080/api/products
```

#### Example request body

```json
{
    "name": "Test Product #1",
    "price": {
        "amount": 10000,
        "currency": "EUR"
    }
}
```

#### Example response

```
200 OK
```
```
{
    "id": "e9e9da64-4415-426f-ab56-8f8940d63aa7"
}
```

#### Heads up!

You can also try a **Postman** collection which is available in the [docs](docs) directory (both env variables and collection).

### CLI

Once you are in the PHP container, you can create a product using the following command:

```shell script
$ bin/console cobiro:product:create [name] [priceAmount] [priceCurrency]
```

### Development

Running code analysis

```shell script
$ composer analyse
```
