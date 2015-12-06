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
$time = Bookworm::estimate($text);
echo $time; // 5 minutes
```

## API
``` php
Bookworm::estimate(string $text, string|array|bool $units = [ ' minute', ' minutes' ]);
```

**Parameters**
- `$text` The piece of text which the estimation should be based upon.
- `$units = [ ' minute', ' minutes' ]` *Optional.* Set it to false, to return just the number of minutes as an integer. If you provide a string, like `m` it will be used for singular and plural and produce `5m`. If you provide an array with two values, the first will be used for singular, the second for plural. `[ ' minute', ' minutes' ]` (not included leading whitespace) will produce `5 minutes`.

**Returns** `int` or `string`

## Configuration
You can configure Bookworm to react other than how it's shipped. You can change the average words per minute & the duration a user needs to look at an image. If you do not want images to factor into the reading time estimate, just set it to 0.

``` php
<?php
use Bookworm\Bookworm;

Bookworm::configure([
    'wordsPerMinute' => 200,
    'codewordsPerMinute' => 200,
    'secondsPerImage' => 12
]);
```

**wordsPerMinute** The average amount of words a user will read per minute (*default 200*).

**codewordsPerMinute** The average amount of words in a code block, a user will read per minute (*default 200*).

**secondsPerImage** The average amount of seconds a user will spent looking at an image (*default 12*).

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
