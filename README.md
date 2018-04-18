# Qapla - API integration for Laravel 5

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Scrutinizer Code Quality][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

An easy [Qapla](https://www.qapla.it/) API integration for your Laravel 5 web application.

## Qapla
Your shipments' best friend.
- Complete control on problematic shipments
- 59 couriers supported in only one dashboard
- Status auto-update and custom tracking page
- Transactional email and support ticket
- Multi-store and multi-platform integration

### 	Documentation
Website: [https://www.qapla.it](https://www.qapla.it)<br>
API: [https://api.qapla.it](https://api.qapla.it)<br>
Webhook: [https://webhook.qapla.it](https://webhook.qapla.it)

## Install

You can install the package via Composer:

``` bash
$ composer require w3designweb/laravel-qapla
```
In Laravel 5.5 and up, the package will automatically register the service provider and facade
In Laravel 5.4 or below start by registering the package's the service provider and facade:

``` php
// config/app.php

'providers' => [
    ...
    W3design\Qapla\QaplaServiceProvider::class,
],

'aliases' => [
    ...
    'Qapla' => W3design\Qapla\QaplaFacade::class,
],
```
The facade is optional, but the rest of this guide assumes you're using the facade.

Next, publish the config files:

``` bash
php artisan vendor:publish --provider="W3design\Qapla\QaplaServiceProvider" --tag="config"
```

## Usage
### The connection to the channel
``` php
use W3design\Qapla\Qapla;
...
$channel = new Qapla($privateApiKey, $publicApiKey);
```

After that you can use all this functions:
- **getTrack()**: Return the status of a shipment using the tracking number.
- **pushTrack()**: Allows one or more shipments to be loaded via a POST request in JSON format.
- **deleteTrack()**: Allows you to delete a shipment.
- **getTracks()**: Return the list of shipments imported from Qapla, with a maximum limit of 100 shipments per call.
- **pushOrder()**: Allows you to load one or more orders via a POST request in JSON format.
- **getOrders()**: Return the list of orders imported from Qapla, with a maximum limit of 100 orders per call.
- **getCredits()**: Return the amount of the remaining credits on your premium account
- **getCouriers()**: Return the list of couriers either total, or for single country/region.

### getTrack()
Return the status of a shipment using the tracking number.<br>
You can retrive a track by "trackingNumber" or "reference".
``` php
$track = $channel->getTrack('trackingNumber', '2878202252347', 'ita');	// by "trackingNumber"
$track = $channel->getTrack('reference', '300008236', 'ita');		// by "reference"
```

### pushTrack()
Allows one or more shipments to be loaded via a POST request in JSON format.<br>
The $data array PHP must follows the guidelines described here: [https://api.qapla.it/#pushTrack](https://api.qapla.it/#pushTrack)
``` php
$data = array(...);
$channel->pushTrack($data);
```

### deleteTrack()
Allows you to delete a shipment by "trackingNumber".
``` php
$channel->deleteTrack('2878202252347');
```

### getTracks()
Return the list of shipments imported from Qapla, with a maximum limit of 100 shipments per call.<br>
You must indicate a "startDate", and you can use a date in format "Y-m-d H:i:s" or an integer number like "36" to mean "36 days before today".
``` php
$tracks = $channel->getTracks('2015-05-21 00:00:00');	// With "Y-m-d H:i:s" format
$tracks = $channel->getTracks('36');			// With "days" format
```

### getOrders()
Return the list of orders imported from Qapla, with a maximum limit of 100 orders per call.<br>
You must indicate a "startDate", and you can use a date in format "Y-m-d H:i:s" or an integer number like "36" to mean "36 days before today".
``` php
$orders = $channel->getOrders('2015-05-21 00:00:00');	// With "Y-m-d H:i:s" format
$orders = $channel->getOrders('36');			// With "days" format
```

### pushOrder()
Allows you to load one or more orders via a POST request in JSON format.<br>
The $data array PHP must follows the guidelines described here: [https://api.qapla.it/#pushOrder](https://api.qapla.it/#pushOrder)
``` php
$data = array(...);
$channel->pushOrder($data);
```

### getCredits()
Return the amount of the remaining credits on your premium account.
``` php
$credits = $channel->getCredits();
```

### getCouriers()
Return the list of couriers either total, or for single country/region.
``` php
$couriers = $channel->getCouriers();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [W3design][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/w3designweb/laravel-qapla.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-scrutinizer]: https://scrutinizer-ci.com/g/w3designweb/laravel-qapla/badges/quality-score.png?b=master
[ico-code-quality]: https://img.shields.io/scrutinizer/g/w3designweb/laravel-qapla.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/w3designweb/laravel-qapla.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/w3designweb/laravel-qapla
[link-scrutinizer]: https://scrutinizer-ci.com/g/w3designweb/laravel-qapla/?branch=master
[link-code-quality]: https://scrutinizer-ci.com/g/w3designweb/laravel-qapla
[link-downloads]: https://packagist.org/packages/w3designweb/laravel-qapla
[link-author]: https://github.com/w3designweb
[link-contributors]: ../../contributors
