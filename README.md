Laravel Vimeo
=============
![image](https://raw.githubusercontent.com/vinkla/vinkla.github.io/master/images/vimeo-package.png)

Laravel wrapper for the official Vimeo API. Read more about the API in the official [Vimeo repository](https://github.com/vimeo/vimeo.php).

```php
// Fetching data.
$vimeo->request('/users/dashron', ['per_page' => 2], 'GET');

// Upload videos.
$vimeo->upload('/home/aaron/foo.mp4', false);

// Wanna use a facade?
Vimeo::uploadImage('/videos/123/images', '/home/aaron/bar.png', true);
```
This package gives you an easy way to handle [Vimeo](https://developer.vimeo.com/apps) configuration keys like client identifier and secret. The package includes a Facade and a contract which you can integrate within your project. Happy coding!

[![Build Status](https://img.shields.io/travis/vinkla/vimeo/master.svg?style=flat)](https://travis-ci.org/vinkla/vimeo)
[![Latest Stable Version](http://img.shields.io/packagist/v/vinkla/vimeo.svg?style=flat)](https://packagist.org/packages/vinkla/vimeo)
[![License](https://img.shields.io/packagist/l/vinkla/vimeo.svg?style=flat)](https://packagist.org/packages/vinkla/vimeo)

## Installation
Require this package in your `composer.json` and update composer. 

```json
{
	"require": {
		"vinkla/vimeo": "~1.0"
	}
}
```

If using [Laravel](http://laravel.com) (not required), add the service provider to ```config/app.php``` in the providers array.

```php
'Vinkla\Vimeo\VimeoServiceProvider'
```

If you want you can use the [facade](http://laravel.com/docs/4.2/facades). Add the reference in ```config/app.php``` to your aliases array.
```php
'Vimeo' => 'Vinkla\Vimeo\Facades\Vimeo'
```

To add the configuration file to your `app/config/packages` directory, run the command below.
```bash
php artisan publish:config vinkla/vimeo
```

## License

The Laravel Vimeo package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
