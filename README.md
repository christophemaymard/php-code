# PhpCode

[![Latest Release](https://img.shields.io/packagist/v/cmaymard/php-code?label=Release&style=plastic)](https://packagist.org/packages/cmaymard/php-code)
[![PHP Version](https://img.shields.io/packagist/php-v/cmaymard/php-code?color=informational&label=PHP&style=plastic)](https://www.php.net/)
[![PHP Extensions](https://img.shields.io/static/v1?label=PHP%20ext&message=mbstring&color=informational&style=plastic)](https://www.php.net/)
[![License](https://img.shields.io/github/license/christophemaymard/php-code?label=License&style=plastic)](LICENSE)

PhpCode provides support to mangle C++ names.

## Installation

```
composer require cmaymard/php-code
```

## Examples

### Mangle C++ names (Itanium encoding)

```php
use PhpCode\Language\Cpp\Mangling\ItaniumMangler;
use PhpCode\Language\Cpp\Specification\LanguageContextFactory;
use PhpCode\Language\Cpp\Specification\Standard;

$languageContextFactory = new LanguageContextFactory();
$languageContext = $languageContextFactory->create(Standard::CPP2017);
$mangler = new ItaniumMangler($languageContext);

// '_Z4mainv'
\var_dump($mangler->mangleFunction('main()'));

// '_Z4calcisjlfdi'
\var_dump($mangler->mangleFunction('calc(int, short, unsigned, long, float, double, signed)'));

// '_ZN9Framework7Logging6Logger3logEN3Log5ETypeEbcwz'
\var_dump($mangler->mangleFunction('Framework::Logging::Logger::log(Log::EType, bool, char, wchar_t, ...)'));
```

For more examples, read the [Mangle C++ names](doc/cpp/mangling.md) documentation.

