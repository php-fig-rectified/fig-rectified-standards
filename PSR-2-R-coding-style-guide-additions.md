# Coding Style Guide Additions

This guide extends and expands on [PSR-2-R], the basic coding style guide.

These additions are totally optional. There was a void in the style guide so far
regarding these additions and as such are notices here as best practice recommendations.

[PSR-2-R]: PSR-2-coding-style-guide.md

Note that `[` and `]` (PHP5.4+) are used instead of `array(` and `)` for array declaration;

## Use Declarations

* Use declarations should be in alphabetical order.

## Properties and variables.

* Properties and variables should be in $StudlyCaps or $camelBacked style.
The first should only be used for objects. In some cases properties can also be `$snake_case`,
but should be avoided if possible.

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
Do not use keyword control structures. Use parantheses instead for consistency across all files:

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

## PHP Open Tags
Always use `<?php` instead of `<?`.

Do not use the `<?= ... =>` short tags. They are also difficult to comment out if desired.
It is better to consistently use
```html
This <?php echo h($var); ?>

Another <?php //echo h($var); ?> commented out one
```
Commenting out with `<!--  -->` should be avoided as it is then visible in the resulting HTML output.

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

### Comparison methods
Consistenty is key here. The project should use one througout the code. In general stick to the short version.

`is_int()` should be used instead of `is_integer()`.
Use `is_writable()` instead of `is_writeable()`.

## Whitespace

* Please use "trim-right" in your IDE settings to avoid unnecessary trailing white space.
* Use one newline at the end of the file. This avoids "missing newline" issues in several git hosting
environments
* Always have a single newline at the beginning and end of each class/trait, resulting from a newline
above and below each method.

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

### Inter-Line Alignment
Don't use inter-line alignment. It is

a) Not useful in combination with tabs as indentation (and personal length adjustment of it).
b) Very bad for change diffs, as it creates a lot of noise. It is also additional work.

```php
public function bar() {
	$foo = 'bar';
	$bazdib = 'gir';
	$zim = 'irk';

	$varname = '1234' . aVeryLongFunctionName()
		. 'foo' . otherFunction();
}
```
The aligment would have to completely change for the above three variables, if one of them
would be named longer, renaming all involved and aligned variables with it. Bad idea.

The second example would result in the same issue. So always use simple spaces for inline and
one-tab indents for multiline aligments.

### Strings and Concatination

`'` or `"`? Both work, as long as they are used consistent throughout a file.
It is recommended to use the single `'` – as `"` is for HTML attributes and parses variables.

Don't use variables inside strings – they are better splitted like that:
```php
echo 'A string with ' . $someVariable . ' and ' . SOME_CONSTANT . '!';
echo '<a href="example.org" title="' . $title . '">Link</a>';
```

In case a string contains `'`, it is applicable to switch to `"` here to avoid
the usage of `\` escapes:
```php
$sql = "UPDATE TABLE 'foo' SET ContactName='Alfred Schmidt', City='Hamburg' WHERE ...";
```

Use a space before and after `.`:
```php
$myString = 'a string' . $variable . 'more string stuff etc';
```

## Multi-line declaration/condition/concatenation
All operators should go in the newline as first character:
```php
$foo = 'Some String'
	. ' concatinated';

if (($a == $b)
	&& ($b == $c)
	|| (Foo::CONST == $d)
) {
	$a = $d;
}
```

### Careful with deep arrays
One mistaked that gets often made:
```php
$foo = [[
	0,
	1, 2
], 3, 4];
```
This would effectivly change all lines (and their indentation), if the array structure got normalized.
Arrays also need to minimize effects on the resulting diff, and as such indentation must always be the right one:
```php
$foo = [[
		0,
		1, 2
	], 3, 4];
```
for example, max. normalized as:
```php
$foo = [
	[
		0,
		1,
		2
	],
	3,
	4
];
```
As you can see, entries like `0` would not need any change on reorganizing, thus reducing overhead in work and making diffs easier to read as
they only show actual changes made.

## Typehinting
Arguments that expect objects, arrays or callbacks (callable) can be typehinted. We only typehint public methods, though, as typehinting is not cost-free:
```php
/**
 * Some method description.
 *
 * @param Model $Model The model to use.
 * @param array $array Some array value.
 * @param callable $callback Some callback.
 * @param bool $boolean Some boolean value.
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
Use `(bool)$var` instead of `!!$var`.

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

In the description itself the verbose versions of `int` and `bool` are used.
Use sentences with a capital first letter and a full stop if possible:
```php
/**
 * Returns output of input.
 *
 * @param int|bool $input Input as integer or boolean value.
 * @return int|bool Output pretty much the same.
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

### Example for return early
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

### Avoid `private` for class methods/properties
Most of the time `private` is used too eagerly, where `protected` would suffice.
Allow extending classes to extend the code. Don't assume it doesn't have to.
This is especially important for frameworks or vendor libraries that people would like to enhance or
customize in their applications.

Read some more about it [here](http://aperiplus.sourceforge.net/visibility.php).

In case you are acquainted with the "Open/Close Principle", it is in some cases OK to use
private to define clear public interfaces for classes.

### Underscores for Private/Protected
It is not directly disallowed in PSR-2 to have the `_` and `__` visibility prefixes.
But it says one has a good reason to use them.
As most IDEs still don't really clearly display (in colors?) the difference between
public, protected and private, the following would be difficult to read:
```php
$x = $this->someAttribute;
$x = $this->someProtectedAttribute;

$this->callToSomeMethod();
$this->callToSomeProtectedMethod();
```
At first glance it will always be impossible to know what visibility the property or method has.

So it is encouraged to stick to that useful practice to prefix:
```php
$x = $this->someAttribute;
$x = $this->_someProtectedAttribute;

$this->callToSomeMethod();
$this->_callToSomeProtectedMethod();
```

Note that `__` is also used for magic calls, and as such this recommendation is best used with the above hint of not using
private visibility in your code.
Otherwise please disregard and make sure you use an IDE that can display them properly. Using underscores with a lot of
private methods will probably be worse than sticking to the PSR-2 recoommendation.

### Return void vs null
Try to document `@return void` when there is just a `return;`, whereas `return null;` or `return $this->foo();` would be
`@return null` or alike.

```php
/**
 * @param string $input
 * @return void
 */
public function setFoo($input) {
	if (!$input) {
		return;
	}
	if ($input === 'foofoo') {
		$this->set('special', $input);
		return;
	}
	$this->set('input', $input);
}

/**
 * @param string $var
 * @return string|null
 */
public function get($var) {
	if (!isset($this->config[$var]) {
		return null;
	}
	return $this->config[$var];
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

## Other

### Files
File names which do not contain classes should be lowercased and underscored, for example:
```
long_file_name.php
```

### .editorconfig
The following is recommended to be put in your root dir (where composer.json is, as well) as `.editorconfig` file:

```
# This file is for unifying the coding style for different editors and IDEs
# editorconfig.org
root = true

[*]
end_of_line = lf
charset = utf-8
indent_style = tab
insert_final_newline = true
trim_trailing_whitespace = true

[*.bat]
end_of_line = crlf

[*.yml]
indent_style = space
indent_size = 2
```
YML files unfortunately are only valid with a 2 space indentation.

### HTML
All tags and attributes are lowercase.

### CSS
Definition ideally as dashed name:
- class: .some-class-name
- id: #some-id-to-an-element

Both with lowercase characters (although classes are not case-sensitive, id’s are!), the separator is minus [-].
You can use underscore [_] if it makes the separation of the identifier and the record id easier. E.g. `my-id_33`.
It will become necessary to do so if you use UUIDs (which contain minus chars).

Note: ids should be unique on the current page – so don’t use them for iterating elements.
In general all styling should be class based. Ids are often abused for that.
But they usually serve the purpose of being identifiable via JS.
So they should ideally be mainly used for dynamic JS scripts.

Do not name the fields after their style, but after the function/meaning – as the style
can change and will result in things like `.red { color: yellow;}`.

Good Example:
```css
span.success {
    /* color: green; // not any more */
    color: dark-green;
}
div.important {
    /* font-weight: bold; // not any more */
    font-size: 14px;
}
```
