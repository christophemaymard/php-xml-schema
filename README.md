# PhpXmlSchema

[![Latest Release](https://img.shields.io/packagist/v/cmaymard/php-xml-schema?label=Release&style=plastic)](https://packagist.org/packages/cmaymard/php-xml-schema)
[![PHP Version](https://img.shields.io/packagist/php-v/cmaymard/php-xml-schema?color=informational&label=PHP&style=plastic)](https://www.php.net/)
[![PHP Extensions](https://img.shields.io/static/v1?label=PHP%20ext&message=GMP&color=informational&style=plastic)](https://www.php.net/)
[![License](https://img.shields.io/github/license/christophemaymard/php-xml-schema?label=License&style=plastic)](LICENSE)

Provides support to parse and create an in-memory representation of a XML Schema document.

## Installation

```
composer require cmaymard/php-xml-schema
```

## Usage

### Parse a XML Schema 1.0 document

```php
<?php

use PhpXmlSchema\Dom\Parser;

$src = \file_get_contents('schema.xsd');

$parser = new Parser();

// $schema is an instance of PhpXmlSchema\Dom\SchemaElement.
$schema = $parser->parse($src);
```

See the [documentation](/doc/dom/Parser.md).