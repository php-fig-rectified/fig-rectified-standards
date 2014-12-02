# Coding Style Guide Additions

This guide extends and expands on [PSR-2-R], the basic coding style guide.

These additions are totally optional. There was a void in the style guide so far
regarding these additions and as such are notices here as best practice recommendations.

[PSR-2-R]: PSR-2-coding-style-guide.md

## Use Declarations

* Use declarations should be in alphabetical order.

## Properties and variables.

* Properties and variables should be in $StudlyCaps or $camelBacked style.
The first should only be used for objects. In some cases properties can also be `$snake_case`,
but should be avoided if possible.

### Example
```php
class Foo {

	public $RequestHandler;

	protected $isBool;

	public function foo($countVar, MyObject $MyObject) {
		$countVar++;
		$MyObject->bar();
	}

}
```

## Traits

Traits are treated as classes.

## Ternary Operator
Ternary operators are permissible when the entire ternary operation fits on one line.
Longer ternaries should be split into if else statements. Ternary operators should not ever be nested.
Optionally parentheses can be used around the condition check of the ternary for clarity:

```php
// Nested ternaries are bad
$variable = isset($options['variable']) ? isset($options['othervar']) ? true : false : false;

// Good, simple and readable
$variable = isset($options['variable']) ? $options['variable'] : true;
```

## Control Structures
Do not use keyword control structures. Use parantheses instead.

```php
// Bad
if ($isAdmin):
	echo '<p>You are the admin user.</p>';
endif;

// Good
if ($isAdmin) {
	echo '<p>You are the admin user.</p>';
}

```

## Comparison

Always try to be as strict as possible. If a none strict test is deliberate it might be
wise to comment it as such to avoid confusing it for a mistake.

For testing if a variable is null, it is recommended to use a strict check:
```php
// Faster and easier than is_null() call
if ($value === null) {
      // ...
}
```
The value to check against should be placed on the right side:
```php
// Yoda style not recommended
if (null === $this->foo()) {
    // ...
}

// Recommended for better (human) readability
if ($this->foo() === null) {
    // ...
}
```

## Whitespace

* Please use "trim-right" in your IDE settings to avoid unnecessary trailing white space.
* Use one newline at the end of the file. This avoids "missing newline" issues in several git hosting
environments
* Always have a single newline at the beginning and end of each class/trait, resulting from a newline
above and below each method.

### Example

This example encompasses some of the rules below as a quick overview:

```php
class Foo extends Bar implements FooInterface {

	public function foo($a, $b = null) {
		// Code here
	}

	public function bar() {
		// Method body
	}

}

```


## Typehinting
Arguments that expect objects, arrays or callbacks (callable) can be typehinted. We only typehint public methods, though, as typehinting is not cost-free:
```php
/**
 * Some method description.
 *
 * @param Model $Model The model to use.
 * @param array $array Some array value.
 * @param callable $callback Some callback.
 * @param boolean $boolean Some boolean value.
 */
public function foo(Model $Model, array $array, callable $callback, $boolean) {
}
```
Here $Model must be an instance of Model, $array must be an array and $callback must be of type callable (a valid callback).

Note that if you want to allow $array to be also an instance of ArrayObject you should not typehint as array accepts only the primitive type:
```php
/**
 * Some method description.
 *
 * @param array|ArrayObject $array Some array value.
 */
public function foo($array) {
}
```

## Method Chaining
Method chaining should have multiple methods spread across separate lines, and indented with one tab:
```php
$email->from('foo@example.com')
    ->to('bar@example.com')
    ->subject('A great message')
    ->send();
```

## Casting
For casting use:

* `(bool)` - Cast to boolean.
* `(int)` - Cast to integer.
* `(float)` - Cast to float.
* `(string)` - Cast to string.
* `(array)` - Cast to array.
* `(object)` - Cast to object.

Please use `(int)$var` instead of `intval($var)` and `(float)$var` instead of `floatval($var)` when applicable.

## Commenting Code
All comments should be written in English, and should in a clear way
describe the commented block of code.

Inline code should use `//` and a single space afterwards.
Use sentences with a capital first letter and a full stop if possible:
```php
// This is a nice inline comment.
$this->doSomehing();
```

Comment blocks, with the exception of the first block in a file, should always be preceded by a newline.

### Tags
Required tags for each function/method are:

* `@param` if applicable
* `@return`
* `@throws` if applicable
* `@triggers` if applicable

in this order.

Constructors/decontructors may not have a `@return` statement,
as they by definition should not return anything.

Additionally these may be useful:

* `@internal` if applicable
* `@see` or `@link`
* `@deprecated` if applicable - using the `@version <vector> <description>` format, where version and description are mandatory.

For PHPUnit:

* `@covers` if applicable
* `@expectedException` if applicable

For additional tags see [phpDocumentator](http://phpdoc.org/).

### Variable types
Variable types for use in DocBlocks:

* `mixed` - A variable with undefined (or multiple) type.
* `int` - Integer type variable (whole number).
* `float` - Float type (point number).
* `bool` - Logical type (true or false).
* `string` - String type (any value in `""` or `''`).
* `null` - Null type. Usually used in conjunction with another type.
* `array` - Array type.
* `object` - Object type. A specific class name should be used if possible.
* `resource` - Resource type (returned by for example mysql_connect()). Remember that when you specify the type as mixed, you should indicate whether it is unknown, or what the possible types are.
* `callable` - Callable function.

You can also combine types using the pipe char:
```
int|bool
```
When combining types it is recommended to order them by the primary expectation in descending order.

For more than two types it is usually best to just use `mixed`.

In the description itself the verbose versions of `int` and `bool` are used:
```php
/**
 * Returns output of input.
 *
 * @param int|bool $input Input as integer or boolean value.
 * @return int|bool Output
 */
public function foo($input) {
    return $input;
}
```

When returning the object itself, e.g. for chaining, one should use `$this` instead:
```php
/**
 * Foo function.
 *
 * @return $this
 */
public function foo() {
    return $this;
}
```

## Writing better code

* Try to accept and return as few types as possible (mixing integer, boolean, string, array, object etc is usually not too good)
* Try to return early in methods/functions to avoid unnecessary depths

### Example
```php
// Bad
public function foo($input, $anotherInput = null) {
	if ($input) {
		if ($anotherInput) {
			if ($anotherInput === $input) {
				// Code
				return true;
			}
		}
	}
	return false;
}

// Good
public function foo($input, $anotherInput = null) {
	if (!$input || !$anotherInput || $anotherInput !== $input) {
		return false;
	}
	// Code
	return true;
}

```

## Example Addresses
For all example URL and mail addresses use `example.com`, `example.org` and `example.net`, for example:

* Email: `someone@example.com`
* WWW: `http://www.example.com`
* FTP: `ftp://ftp.example.com`

The `example.com` domain name has been reserved for this (see [RFC 2606](http://tools.ietf.org/html/rfc2606.html)) and is recommended
for use in documentation or as examples.

## Line Length (Relaxed addition to original recommendation)
It is recommended to keep lines at approximately 100 characters long for better code readability.
Lines must not be longer than 120 characters.

In short:

* 100 characters is the soft limit.
* 120 characters is the hard limit.

## Files
File names which do not contain classes should be lowercased and underscored, for example:
```
long_file_name.php
```