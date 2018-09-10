# API RESTFul with Laravel

Laravel Framework: 5.7

PHP: 7.1.4

# Installation
1: Download the zip file or git clone the project.

2: Install laravel [https://laravel.com/docs/5.7/installation].

## Configuring database
1: You must edit or create `.env` file in project's root path, configuring the DB_DATABASE, DB_USERNAME and DB_PASSWORD.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_database_name
DB_USERNAME=my_username_database
DB_PASSWORD=my_password_database
```
2: Create a new database with the same name [DB_DATABASE] in your MySQL.

3: Go to the project root path.

4: Run the command:

```
$ composer install
```

5: Migrate data model:

```
$ php artisan migrate
```

6: Database seeding is the process of filling up our database with dummy data that we can use to test it.

```
$ php artisan db:seed
```

7: Running the application:
```
$ php artisan serve
```

# Test using Postman [https://www.getpostman.com/]
- **Create** Article: `[POST] http://localhost:8000/api/articles/`
- **Retrieve all** Articles: `[GET] http://localhost:8000/api/articles/`
- **Retrieve single** Article: `[GET] http://localhost:8000/api/articles/{id}`
- **Update** an Article: `[PUT] http://localhost:8000/api/articles/{id}`
- **Delete** an Article: `[DELETE] http://localhost:8000/api/articles/{id}`
