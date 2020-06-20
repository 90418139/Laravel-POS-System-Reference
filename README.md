<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Laravel-POS-System-Reference

Laravel Framework 7.12.0

Under construction...

## step 1:

Get this project.

Open command line enter this.

```
git clone https://github.com/90418139/Laravel-POS-System-Reference
cd Laravel-POS-System-Reference
composer install
cp .env.example .env
php artisan key:generate
``` 

Git not anwser? <a href='https://git-scm.com/'>Git</a>

Composer not answer? <a href='https://getcomposer.org/'>Composer</a>

## step 2:

Edit '.env'

```$xslt
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=(your sql database name)
DB_USERNAME=(your sql username)
DB_PASSWORD=(your sql password)
```

## step 3:

Make sql table

You can use command line or by hand

    php artisan migrate
    
If you don't have sql server.you can install "<a href="https://www.apachefriends.org/download.html">XAMPP</a>".



## step 4:

Start project.

    php artisan serve

Finish!!
