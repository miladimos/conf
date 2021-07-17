
Laravel config package


### Install 

1.   How to install
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


services:

```php
use Miladimos\Conf\Services\ConfigJsonService;

ConfigJsonService::all(); // return all stored configs in config.json file
ConfigJsonService::show($id); // receive id of config and return one config
ConfigJsonService::store($date); 
// receive ['key' => 'your_key', 'value' => 'your_value'] 
ConfigJsonService::update($date, $id); 
// receive id of config and ['key' => 'your_key', 'value' => 'your_value'] for update
ConfigJsonService::delete($id); // receive id of config and  delete
```

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

then give to config.json file read,write permissions or change owner file to current user:

```
sudo chown -R $USER config.json
```



