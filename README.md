# What to do API client

[//]: # ([![Latest Version on Packagist]&#40;https://img.shields.io/packagist/v/lase-peco/records.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/lase-peco/records&#41;)

[//]: # ([![Total Downloads]&#40;https://img.shields.io/packagist/dt/lase-peco/records.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/lase-peco/records&#41;)

The `abdulsalamemesh/what-to-do-api-client` is a simple client to communicate with the api of what-to-do-api.com.

## Installation

You can install the package via composer:

```bash
composer require abdulsalamemesh/what-to-do-api-client
```

## Usage

### Get a random task

You can fetch a random task using the facade ``AbdulsalamEmesh\WhatToDo\Facades\WhatToDo``

```php
use AbdulsalamEmesh\WhatToDo\Facades\WhatToDo;

WhatToDo::getTask();
```

### Filter the task

You can bind the following methods on your call to filter the result.

The methods are: ```category```, ```person```, ```cost```, ```language```, ```identifier```.

Example:

```php
$task = WhatToDo::category('fun')->person(1)->cost('$')->language('en')->identifier('1sdre5')->getTask();
```

### Create a Task

You can create a task b calling the ```create``` method on the facade and providing it with the data. 

The api will take your task and the language that you selected and use it as a base language to translate the task to all supported languages.

```php
$data = [
    'language' => 'en',
    'task'     => 'play football',
    'category' => 'fun',
    'person'   => 4,
    'cost'     => '$',
    'links'    => [
      'en' => 'https://www.google.com/'
      'de' => 'https://www.google.com/?hl=de'
    ],
];

$task = WhatToDo::create($data);

dd($task);
// return a collection of the following data:
[
    "identifier" => "8892a2"
    "task" =>  [
      "en-US" => "play football"
      "de" => "Fußball spielen"
      "es" => "jugar al fútbol"
      "fr" => "jouer au football"
      "it" => "giocare a calcio"
      "tr" => "futbol oynamak"
      "uk" => "грати у футбол"
    ]
    "category" => "fun"
    "person" => 4
    "cost" => "$"
    "links" => [
      "en" => "https://www.google.com/"
      "de" => "https://www.google.com/?hl=de"
      "es" => ""
      "fr" => ""
      "it" => ""
      "tr" => ""
      "uk" => ""
    ]
  ]

```

### Supported languages

The supported languages are:

```PHP
$supportedLanguages = [
        'en-US' => 'english',
        'de'    => 'german',
        'es'    => 'spanish',
        'fr'    => 'french',
        'it'    => 'italian',
        'tr'    => 'turkish',
        'uk'    => 'ukrainian',
];

```

### Supported costs

The supported costs are:

```PHP
$supportedCosts = ['free', '$', '$$', '$$$'];
```
### Person count

Min is 1 and Max is 10

## Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email contact@abdulsalam-emesh.me instead of using the issue tracker.

## Credits

- [Abdulsalam Emesh](https://github.com/abdulsalamemesh)
- [All Contributors](CONTRIBUTING.md)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
