- [![Starts](https://img.shields.io/github/stars/miladimos/conf?style=flat&logo=github)](https://github.com/miladimos/conf/forks)
- [![Forks](https://img.shields.io/github/forks/miladimos/conf?style=flat&logo=github)](https://github.com/miladimos/conf/stargazers)

- [فارسی](README.md)

# laravel Package
  A package for fun

### Installation

1. Run the command below to add this package:
```
composer require miladimos/conf
```

2. Open your conf/app.php and add the following to the providers array:
```php
Miladimos\Conf\Providers\ConfServiceProvider::class,
```

3. Run the command below to publish the package conf file config/conf.php:
```
php artisan vendor:publish
```
