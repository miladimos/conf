- [![Starts](https://img.shields.io/github/stars/miladimos/conf?style=flat&logo=github)](https://github.com/miladimos/conf/forks)
- [![Forks](https://img.shields.io/github/forks/miladimos/conf?style=flat&logo=github)](https://github.com/miladimos/conf/stargazers)


- [English](README-en.md)

# پکیج لاراولی 
  یه پکیج خفن


### نصب 

1.  برای نصب در مسیر روت پروژه خود دستور زیر را در ریشه پروژه اجرا کنید 
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
