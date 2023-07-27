# A little admin with TALL Sack - Laravel, Livewire, ApineJs, TailwindCss

### Make everything you want
If you knew laravel nova or filament, it's work the same way. 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/webplusmultimedia/little-admin-architect.svg?style=flat-square)](https://packagist.org/packages/webplusmultimedia/little-admin-architect)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/webplusmultimedia/little-admin-architect/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/webplusmultimedia/little-admin-architect/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/webplusmultimedia/little-admin-architect/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/webplusmultimedia/little-admin-architect/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/webplusmultimedia/little-admin-architect.svg?style=flat-square)](https://packagist.org/packages/webplusmultimedia/little-admin-architect)

[![S-lection-023.png](https://i.postimg.cc/jjS5wJMk/S-lection-023.png)](https://postimg.cc/qNW0WgV8)
### This package is under development. do not use it in production for now.

## Support us

Soon

## Installation

You can install the package via composer:

```bash
composer require webplusmultimedia/little-admin-architect
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="little-admin-architect-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="little-admin-architect-views"
```

## Usage
### Make de resource :

```bash
php artisan make:la-resource resourceName -GgroupeName
```
See the documentation (...)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [daniel RMC](https://github.com/webplusmultimedia)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
