# About
Azzara is a beautiful and elegant Bootstrap 4 admin dashboard designed to manage and visualize data about your business. It combines easy colors on the eyes, wide cards, beautiful typography, and graphics.

This project using repository pattern on User & Group User module based on Laravel 10. 
We are also using yajra/laravel-datatables to display data on table and show tree menu on side page.

## Repository pattern
Repositories are classes or components that encapsulate the logic required to access data sources. They centralize common data access functionality, providing better maintainability and decoupling the infrastructure or technology used to access databases from the domain model layer. [Microsoft](https://docs.microsoft.com/en-us/dotnet/architecture/microservices/microservice-ddd-cqrs-patterns/infrastructure-persistence-layer-design) 

## How to Run 
- Copy `.env.example` file to .env inside your project root and fill the database information.
- Open the console and cd your project root directory
- Run `composer install` or `php composer.phar install`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan db:seed` to run seeders
- Run `php artisan serve`
- From browser you can access this application on localhost:8000 or http://127.0.0.1:8000