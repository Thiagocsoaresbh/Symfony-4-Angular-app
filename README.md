# Symfony Angular Project

## Overview

This project is a Symfony and Angular application for managing purchases.

## Prerequisites

Make sure you have the following installed:

- PHP
- Composer
- Node.js
- Symfony CLI
- Angular CLI

## Setup

### Symfony Backend

1. Clone the repository:

    ```bash
    git clone <repository-url>
    ```

2. Install dependencies:

    ```bash
    cd symfony4angular
    composer install
    ```
3.  Start the Symfony server:

    ```bash
    symfony server:start
    ```
    
### Angular Frontend

1. Navigate to the angular-app directory:

    ```bash
    cd my-angular-app
    ```
    
2. Install dependencies:

    ```bash
    npm install

3. Start the Angular development server:

    ```bash
    php -S localhost:8001 -t public
    ```

## Unit Tests
### Create purchase test:
-Tests the creation of a purchase.
-Send a POST request to /create-purchase.
- Check if the response has the status code 200, if it is JSON, and if it contains the message and Purchase_id keys.

## List Shopping Test:
- Test the shopping list.
- Send a GET request to /list-purchases.
- Check if the response has the status code 200, if it is JSON, and if it contains the purchasing key.
- Update Purchase Status Test:

### Tests updating the status of a purchase.
- Simulates the creation of a purchase to obtain the ID.
- Send a PUT request to /update-purchase-status/{$purchaseId}/{$newStatus}.
- Check that the response has the status code 200, is JSON, and contains the message key.

*Aplying in Test-Driven Development (TDD)*

### Usage
- Access the Symfony application at http://localhost:8001
- Access the Angular application at http://localhost:4200

### Features

## Create Purchase:

- Endpoint: /purchase/create_purchase
- Method: POST
- Description: Create a new purchase.

## Update Purchase Status:

- Endpoint: /purchase/update_purchase_status/{purchaseId}/{newStatus}
- Method: POST
- Description: Update the status of a purchase.

## List Purchases:

- Endpoint: /purchase/list_purchases
- Method: GET
- Description: List all purchases with pagination.

## Project Structure
- symfony4angular/: Symfony backend application.
- angular-app/: Angular frontend application.

## Recipes

### doctrine/doctrine-bundle

Package for integrating Doctrine ORM into Symfony. [Read more](https://symfony.com/doc/current/doctrine.html)

### doctrine/doctrine-migrations-bundle

Package for managing database migrations with Doctrine. [Read more](https://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html)

### knplabs/knp-paginator-bundle

Package to add pagination functionality to Symfony. [Read more](https://github.com/KnpLabs/KnpPaginatorBundle)

### phpunit/phpunit

Package for PHPUnit support, a testing framework for PHP. [Read more](https://phpunit.de/)

### symfony/asset-mapper

(Description not provided)

### symfony/console

Package for creating and running console commands. [Read more](https://symfony.com/doc/current/components/console.html)

### symfony/debug-bundle

(Description not provided)

### symfony/flex

Package management tool for Symfony projects. [Read more](https://flex.symfony.com/)

### symfony/framework-bundle

The core of the Symfony framework. [Read more](https://symfony.com/doc/current/bundles/FrameworkBundle/index.html)

### symfony/mailer

Package for sending emails in Symfony projects. [Read more](https://symfony.com/doc/current/mailer.html)

### symfony/maker-bundle

Package for automatically generating boilerplate code. [Read more](https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html)

### symfony/messenger

Package for implementing the message pattern in Symfony. [Read more](https://symfony.com/doc/current/messenger.html)

### symfony/monolog-bundle

Package for integration with Monolog, a PHP logging library. [Read more](https://symfony.com/doc/current/logging.html)

### symfony/notifier

Package for sending notifications via different channels (email, Slack, etc.). [Read more](https://symfony.com/doc/current/notifier.html)

### symfony/phpunit-bridge

(Description not provided)

### symfony/routing

Package for handling routes in Symfony projects. [Read more](https://symfony.com/doc/current/routing.html)

### symfony/security-bundle

Package for managing security in Symfony projects. [Read more](https://symfony.com/doc/current/security.html)

### symfony/stimulus-bundle

Package for integrating with Stimulus, a JavaScript framework. [Read more](https://symfony.com/doc/current/stimulus.html)

### symfony/translation

Package for managing translations in Symfony projects. [Read more](https://symfony.com/doc/current/translation.html)

### symfony/twig-bundle

Package for integrating with Twig, a PHP template engine. [Read more](https://symfony.com/doc/current/templating.html)

### symfony/ux-turbo

(Description not provided)

### symfony/validator

Package for data validation in Symfony projects. [Read more](https://symfony.com/doc/current/validation.html)

### symfony/web-profiler-bundle

Package for the web profiler in Symfony projects. [Read more](https://symfony.com/doc/current/profiler.html)

### symfony/webapp-pack

(Description not provided)

### twig/extra-bundle

(Description not provided)

## Technologies Used

![Symfony](https://cdn.jsdelivr.net/gh/devicons/devicon/icons/symfony/symfony-original.svg | width=50)
![Angular](https://cdn.jsdelivr.net/gh/devicons/devicon/icons/angularjs/angularjs-original.svg | width=50)
![Doctrine](https://cdn.jsdelivr.net/gh/devicons/devicon/icons/doctrine/doctrine-original-wordmark.svg | width=50)
![Composer](https://cdn.jsdelivr.net/gh/devicons/devicon/icons/composer/composer-original.svg | width=50)
![Docker](https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original-wordmark.svg" | width=50)
![JavaScript](https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" | width=50)
![SASS](https://cdn.jsdelivr.net/gh/devicons/devicon/icons/sass/sass-original.svg" | width=50)
![TypeScript](https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg" | width=50)
        

## Autor

- **Thiago C Soares**

## Contributing
- Contributions are welcome! Please follow the Contribution Guidelines.[CONTRIBUTING](CONTRIBUTING.MD)

## License
This project is licensed under the [MIT License](LICENSE).