# PhpXmlSchema

## Requirements

PhpXmlSchema requires:
* **PHP version**: 7.0 or higher
* **PHP extensions**:
  * GMP

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
