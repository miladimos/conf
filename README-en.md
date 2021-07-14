
- (README.md)

# Laravel config package

### Installation

1. Run the command below to add this package:
```
composer require miladimos/conf
```

2. Open your conf/app.php and add the following to the providers array:
```php
Miladimos\Conf\Providers\ConfServiceProvider::class,
```

3. Run the command below to install package:
```
php artisan conf:install
```

helpers:

conf('key') // return value of config

routes:
```php
GET  api/version/conf/all          -> name: conf.all // return all configs
GET  api/version/conf/show/{id}    -> name: conf.show // return single config
POST api/version/conf/update/{id}  -> name: conf.update // update
POST api/version/conf/store        -> name: conf.store // store
GET  api/version/conf/delete/{id}  -> name: conf.delete // delete
```
update and store receive these datas
```php
[
    'key' => 'yourkey',
    'value' => 'yourvalue'
]
```
