# Censorship
Censorship is a PHP library that covers up undesired words

## Getting Started
First, you'll need to `load` an array of censored words.
```php
$censorship = new Chaucerbao\Censorship;
$censorship->load(['happy', 'flower']);
$censorship->censor('I am so happy when I get flowers for my birthday!');

// I am so ***** when I get ******* for my birthday!
```

You can also load words from the constructor
```php
$censorship = new Chaucerbao\Censorship(['happy', 'flower']);
```

If you prefer to cover the letters with a different symbol, you can use either:
```php
$censorship->setSymbol('-'); // Changes the default symbol for future calls
$censorship->censor('Your sentence.', '-'); // Uses the symbol for this instance only
```

## Public methods
### Load undesired words
```php
void load(array $words)
```

### Set the symbol
You can change the default symbol (\*) used to cover up the letters.
```php
void setSymbol(string $symbol)
```

### Censor the text
Returns the text with the undesired words covered. Passing in a `$symbol` will override the default symbol for this call.
```php
string censor(string $text[, string $symbol])
```
