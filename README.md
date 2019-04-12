# Laravel Vimeo

![vimeo](https://cloud.githubusercontent.com/assets/499192/11158771/b3f80b2c-8a5a-11e5-82e5-5db4be19b4ce.png)

> A [Vimeo](https://vimeo.com) bridge for Laravel.

```php
// Fetching data.
$vimeo->request('/users/dashron', ['per_page' => 2], 'GET');

// Upload videos.
$vimeo->upload('/home/aaron/foo.mp4');

// Want to use a facade?
Vimeo::uploadImage('/videos/123/images', '/home/aaron/bar.png', true);
```

[![Build Status](https://img.shields.io/travis/vimeo/laravel/master.svg?style=flat)](https://travis-ci.org/vimeo/laravel)
[![StyleCI](https://styleci.io/repos/25986926/shield?style=flat)](https://styleci.io/repos/25986926)
[![Coverage Status](https://img.shields.io/codecov/c/github/vimeo/laravel.svg?style=flat)](https://codecov.io/github/vimeo/laravel)
[![Latest Version](https://img.shields.io/github/release/vimeo/laravel.svg?style=flat)](https://github.com/vimeo/laravel/releases)
[![License](https://img.shields.io/packagist/l/vimeo/laravel.svg?style=flat)](https://packagist.org/packages/vimeo/laravel)

## Installation
Require this package, with [Composer](https://getcomposer.org), in the root directory of your project.

```bash
$ composer require vimeo/laravel
```

Add the service provider to `config/app.php` in the `providers` array, or if you're using Laravel 5.5, this can be done via the automatic package discovery.

```php
Vimeo\Laravel\VimeoServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'Vimeo' => Vimeo\Laravel\Facades\Vimeo::class
```

## Configuration

Laravel Vimeo requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="Vimeo\Laravel\VimeoServiceProvider"
```

This will create a `config/vimeo.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

You are free to change the configuration file as needed, but the default expected values are below:

```php
VIMEO_CLIENT=
VIMEO_SECRET=
VIMEO_ACCESS=
```

and for setting up the alternate connection...

```php
VIMEO_ALT_CLIENT=
VIMEO_ALT_SECRET=
VIMEO_ALT_ACCESS=
```

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
use Vimeo\Laravel\Facades\Vimeo;

Vimeo::request('/me/videos', ['per_page' => 10], 'GET');
// We're done here - how easy was that, it just works!

Vimeo::upload('/bar.mp4');
// This example is simple and there are far more methods available.
```

The Vimeo manager will behave like it is a `Vimeo\Vimeo`. If you want to call specific connections, you can do that with the connection method:

```php
use Vimeo\Laravel\Facades\Vimeo;

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
use Vimeo\Laravel\VimeoManager;

class Foo
{
    protected $vimeo;

    public function __construct(VimeoManager $vimeo)
    {
        $this->vimeo = $vimeo;
    }

    public function bar()
    {
        $this->vimeo->upload('/foo.mp4');
    }
}

App::make('Foo')->bar();
```

## Documentation

There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [the official Vimeo package](https://github.com/vimeo/vimeo.php).

## License

[Apache License 2.0](LICENSE) © [Vimeo](https://vimeo.com/)
