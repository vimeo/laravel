Laravel Vimeo
=============
![image](https://raw.githubusercontent.com/vinkla/vinkla.github.io/master/images/vimeo-package.png)

Laravel [Vimeo](https://vimeo.com/) is a [Vimeo](https://vimeo.com/) bridge for Laravel 5 using the [official Vimeo package](https://github.com/vimeo/vimeo.php).

```php
// Fetching data.
$vimeo->request('/users/dashron', ['per_page' => 2], 'GET');

// Upload videos.
$vimeo->upload('/home/aaron/foo.mp4', false);

// Want to use a facade?
Vimeo::uploadImage('/videos/123/images', '/home/aaron/bar.png', true);
```
This package gives you an easy way to handle [Vimeo](https://developer.vimeo.com/apps) configuration keys like client identifier and secret. The package includes a Facade and a contract which you can integrate within your project. Happy coding!

[![Build Status](https://img.shields.io/travis/vinkla/vimeo/master.svg?style=flat)](https://travis-ci.org/vinkla/vimeo)
[![StyleCI](https://styleci.io/repos/25986926/shield?style=flat)](https://styleci.io/repos/25986926)
[![Latest Stable Version](http://img.shields.io/packagist/v/vinkla/vimeo.svg?style=flat)](https://packagist.org/packages/vinkla/vimeo)
[![License](https://img.shields.io/packagist/l/vinkla/vimeo.svg?style=flat)](https://packagist.org/packages/vinkla/vimeo)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require vinkla/vimeo:~2.0
```

Add the service provider to ```config/app.php``` in the `providers` array.

```php
'Vinkla\Vimeo\VimeoServiceProvider'
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in ```config/app.php``` to your aliases array.

```php
'Vimeo' => 'Vinkla\Vimeo\Facades\Vimeo'
```

#### Looking for a Laravel 4 compatable version?

Please use `1.0` branch instead. Installable by requiring:

```bash
composer require vinkla/vimeo:~1.0
```

## Configuration

Laravel Vimeo requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
php artisan vendor:publish
```

This will create a `config/vimeo.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### Vimeo Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

## Usage

#### VimeoManager

This is the class of most interest. It is bound to the ioc container as `vimeo` and can be accessed using the `Facades\Vimeo` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `Vimeo\Vimeo`.

#### Facades\Vimeo

This facade will dynamically pass static method calls to the `vimeo` object in the ioc container which by default is the `VimeoManager` class.

#### VimeoServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples
Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use Vinkla\Vimeo\Facades\Vimeo;

Vimeo::request('/me/videos', ['per_page' => 10], 'GET');
// We're done here - how easy was that, it just works!

Vimeo::upload('/bar.mp4', false);
// This example is simple and there are far more methods available.
```

The Vimeo manager will behave like it is a `Vimeo\Vimeo`. If you want to call specific connections, you can do that with the connection method:

```php
use Vinkla\Vimeo\Facades\Vimeo;

// Writing this…
Vimeo::connection('main')->upload('/bar.mp4');

// …is identical to writing this
Vimeo::upload('/bar.mp4');

// and is also identical to writing this.
Vimeo::connection()->upload('/bar.mp4');

// This is because the main connection is configured to be the default.
Vimeo::getDefaultConnection(); // This will return main.

// We can change the default connection.
Vimeo::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use Vinkla\Vimeo\VimeoManager;

class Foo
{
	protected $vimeo;

	public function __construct(VimeoManager $vimeo)
	{
		$this->vimeo = $vimeo;
	}

	public function bar()
	{
		$this->vimeo->upload('/foo.mp4', false);
	}
}

App::make('Foo')->bar();
```

## Documentation
There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [the official Vimeo package](https://github.com/vimeo/vimeo.php).

## License

The Laravel Vimeo package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
