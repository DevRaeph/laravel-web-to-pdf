<p align="center"><img src="https://i.postimg.cc/nVmxVpyz/Github-Social-Bar.jpg" alt="Social Card of laravel-web-to-pdf"></p>

# DevRaeph / laravel-web-to-pdf
[![Total Downloads]](https://packagist.org/packages/devraeph/laravel-web-to-pdf)
[![Latest Stable Version]](https://packagist.org/packages/devraeph/laravel-web-to-pdf)
[![Issues]](https://github.com/DevRaeph/laravel-web-to-pdf/issues)

A simple package with which you can convert URL WebPages to PDF.
You require a valid API-Token.

## Installation

Package is available on [Packagist](https://packagist.org/packages/devraeph/laravel-web-to-pdf),
you can install it using [Composer](https://getcomposer.org).

```shell
composer require devraeph/laravel-web-to-pdf
```

Publish Config
```shell
php artisan vendor:publish --provider="DevRaeph\WebToPdf\WebToPDFServiceProvider" --tag="config"
```
## Documentation

Converting a URL to PDF:<br>
```php
use DevRaeph\WebToPdf\Facades\WebToPDF;

$myPDF = WebToPDF::setUrl(/* URL */)
        ->setFileName(/* Custom FileName */)//OPTIONAL
        ->setDelay(/* Default 50 */)//OPTIONAL
        ->setFullPage(/* Default false */)//OPTIONAL
        ->generate();      
        
return $myPDF->toFile(); //Stream Download
return $myPDF->toUrl();  //Return Download URL
```



[Total Downloads]: https://img.shields.io/packagist/dt/devraeph/laravel-web-to-pdf
[Latest Stable Version]: https://img.shields.io/packagist/v/devraeph/laravel-web-to-pdf
[Issues]: https://img.shields.io/github/issues/DevRaeph/laravel-web-to-pdf
