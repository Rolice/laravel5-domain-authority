# laravel5-domain-authority
Domain authority API consumer for Laravel 5 and inclusively any composer project, relying on [Moz](http://moz.com).

This package is designed to consume statistical data from Moz API service. In order to utilize the functionality you should have at least free moz account, which can be registered here: https://moz.com/community/join.

The API provide SEO, ranking and authority statistics about a websites, specific domains or subdomains, single pages and internal/external linking.

This package is in basic development phase and not all fields and functionalities are covered. However the base is ready and it is matter of definition to fulfill other property data. Link metrics are missing and batch domain requests are not implemented as well.

The package is tested only on Laravel 5. It can be adapted for Laravel 4 easily as it does not depend on the framework heavily.

Feel free to fork and commit improvements and extensions of the project.
The issues section is open for comments, problem reports and suggestions.

## Requirements
Installations via composer exclusively will require **64-bit version of PHP**, due to high values in the bit-fields, used to query Moz API. A fix is not planned currently for **32-bit versions of PHP**, since it will require major extension to support it without crapping the style with hardcoded values as strings.

With manual installation it will work correctly util the column value or bitwise sum of columns for mozspace API exceed integer size on 32-bit platforms (32-bit builds of PHP).

Read more about this issue on [URL Metrics](https://github.com/Rolice/laravel5-domain-authority/wiki/Url-Metrics) page in the project Wiki.

## Implementation Level (Supported API)
Here is defined the progress of implementation against Moz API. End-points marked with **+** are implemented, those with **-** are not.

* Anchor Text Metrics (-)
* Link Metrics (-)
* Top Pages (-)
* URL Metrics (+)
* Index Metadata (-)

### Additional Features
* Domain Age Calculator - an interface gathering registration/creation/activation date of a domain and age calculation. 


## Installation
The installation process is extremely easy with composer.

Use for production installations:

`composer require 'rolice/laravel5-domain-authority:0.3.2'` (production, stable)

Latest development version:

`composer require 'rolice/laravel5-domain-authority:dev-master'` (latest, unstable)

Once the package is set up for you with the help of composer you have to define service provider and aliases in the application config file, located at `<project_root>/config/app.php`.

```php
    'providers' => [
        // ...
        // ...
        'DomainAuthority\ServiceProvider',
    ],
    
    // ...
    
    'aliases' => [
        // ...
        // ...
        'DomainAge'             => 'DomainAuthority\DomainAge',
        'DomainAuthority'       => 'DomainAuthority\DomainAuthority',
        'UrlMetrics'            => 'DomainAuthority\UrlMetrics',
    ],
```

The two records in aliases section will allow you to use these classes directly into the views, without calling them through their full namespace.

After you are done you have to publish the the package through the following artisan command:

`php artisan vendor:publish`

This is required in order to publish the config of the package directly in application config folder. You will find there the new file named `domainauthority.php`. Edit it and enter the data from your Moz account service authorization:

* *Access ID*
* *Secret Key*

They can be obtained from the [**Access** section of your **API Dashboard** in Moz] (https://moz.com/products/mozscape/access).

Now you are ready to consume the data.

## Usage
Currently only URL metrics are implemented.
An example how to collect title data and domain authority about an URL is written below:

```php
// Gather data in controller, model or anywhere it is appropriate to do so
$data = App::make('DomainAuthority')
    ->urlMetrics('www.seomoz.org', UrlMetrics::DomainAuthority | UrlMetrics::Title);

// Display results somewhere in the views with Blade template engine
{{ $data->DomainAuthority }} / {{ $data->Title }}
```
The `get` method of the `DomainAuthority` requires an URL address and columns. The columns are passed in the same style as for the Moz API - in bit field. The result is an instance of `UrlMetrics`, with fields named same way as the columns requested (the class constants).

**Caution**: These fields are dynamically generated with the help of `__get` magic method and `ReflectionClass`. They are not defined in the `UrlMetrics` class. Some functions like `proprty_exists` may fail on detecting them.

### Domain Age Usage
You can use Domain Age interface fairly easily. It works with who.is website and parses the dates from their response. The class is named `DomainAge`. It contains three methods:

* since - method that retrieves the registration date of a domain
* age - method that calls since and gives the current age of a domain, measured in years
* fromDate - directly calcualate age by given date in string format, again, in years

```
$since = App::make('DomainAge')->since($this->item->url); // The $since variable will contain Carbon instance or null on failure
$age =  App::make('DomainAge')->age($this->item->url); // Will contain int with years of age, months and others are ignored
$age2 = DomainAge::fromDate('2010-10-01'); // This will calculate directly age from the given date, useful with previously stored values
```

**Inpotant**: Keep in mind that `since` and `age` methods will produce cURL request to who.is website, and exceeding certain limits may result in temporarily unavailable service or ban. A good idea here is to store domain birth date returned from `since` method in some data repository (DB, FileSystem, etc.) and use `fromDate` to directly get age later without new requests.