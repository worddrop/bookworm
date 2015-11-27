# Bookworm (by Worddrop) [![Build Status](https://travis-ci.org/worddrop/bookworm.svg?branch=master)](https://travis-ci.org/worddrop/bookworm)
Bookworm estimates how much time is needed to read a certain piece of text.

## Installation
Currently, the only reliable way (and recommended way) to install Bookworm is by using PHP's package manager Composer.

### Using Composer
``` json
{
    "require": {
        "worddrop/bookworm": "dev-master"
    }
}
```

## Usage
``` php
<?php
use Bookworm\Bookworm;

$text = '...';
$time = Bookworm::estimate($text, Bookworm::TYPE_SHORT);
echo $time; // 5 min
```

## API
``` php
Bookworm::estimate(string $text, int $type = Bookworm::TYPE_SHORT);
```

**Parameters**
- `$text` The piece of text which the estimation should be based upon.
- `[$type = Bookworm::TYPE_SHORT]` You can use either `Bookworm::TYPE_SHORT` or `Bookworm::TYPE_LONG`.

**Returns** `string`

## Configuration
You can configure Bookworm to react other than how it's shipped. You can change translations and the average words per minute.

``` php
<?php
use Bookworm\Bookworm;

Bookworm::configure(array(
    'min'    => 'min',
    'minute' => 'minuut'
), 300);
```

The default amount of words per minute is set on 200.

## License
This project is licensed under MIT license. For the full copyright and license information, please view the LICENSE file
that was distributed with this source code.

## Contributing
You may contribute in any way you want, as long as you agree that your code will be licensed under the same license as
the project itself.

Please make sure to run the tests before committing.

```bash
$ composer test
```
