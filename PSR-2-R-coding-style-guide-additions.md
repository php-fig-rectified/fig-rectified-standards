# Coding Style Guide Additions

This guide extends and expands on [PSR-2-R], the basic coding style guide.

These additions are totally optional. There was a void in the style guide so far
regarding these additions and as such are notices here as best practice recommendations.

[PSR-2-R]: PSR-2-coding-style-guide.md
a
Note that `[` and `]` (PHP5.4+) are used instead of `array(` and `)` for array declaration;

## Use Declarations

* Use declarations should be in alphabetical order.

## Properties and variables.

* Properties and variables should be in $StudlyCaps or $camelBacked style.
The first should only be used for objects. In some cases properties can also be `$snake_case`,
but should be avoided if possible.

```php
class Foo
{
    public $RequestHandler;

    protected $isBool;

    public function foo($countVar, MyObject $MyObject)
    {
        $countVar++;
        $MyObject->bar();
    }
}
```

## Structure
- Use parentheses when instantiating classes regardless of the number of arguments the constructor has.
- Declare class properties before methods.
- Declare public methods first, then protected ones and finally private ones.
The exceptions (when using PHPUnit) to this rule are the class constructor and the `setUp` and `tearDown` methods of PHPUnit tests,
which should always be the first methods to increase readability.

## Traits

Traits are treated as classes.

## Ternary Operator
Ternary operators are permissible when the entire ternary operation fits on one line.
Longer ternaries should be split into if else statements. Ternary operators should not ever be nested.
Optionally parentheses can be used around the condition check of the ternary for clarity:

```php
// Nested ternaries are bad.
$variable = isset($options['variable']) ? isset($options['othervar']) ? true : false : false;

// Good, simple and readable.
$variable = isset($options['variable']) ? $options['variable'] : true;
```

## Control Structures
Do not use keyword control structures. Use curly brackets instead for consistency across all files:

```php
// Bad.
if ($isAdmin):
    echo '<p>You are the admin user.</p>';
endif;

// Good.
if ($isAdmin) {
    echo '<p>You are the admin user.</p>';
}

```
Most IDEs even nowadays can't show start/end for keywords, with brackets it always works in pretty much every IDE, though.

If you intend to use the keywords in template files, you should at least be consistent and use them througout the files.
But in general it is better to also stick to curly brackets here for consistency throughout the codebase.

## PHP Open Tags
Always use `<?php` or `<?=` instead of `<?`.

The `<?=` form should be used for echoing values of simple variables while the `<?php` form can be used for more complex code.

The short form is supported by the newest PHP versions as well and it makes your files less verbose, thus easier to read. It doesn't even require the semicolon (`;`) so feel free to omit it. 
```html
This <?= $x ?> way.
```
If you want to comment it out then you can do it easily:
```html
This <?//= $x ?> way.
```
Commenting out with `<!--  -->` should be avoided as it is then visible in the resulting HTML output.

## Comparison

Always try to be as strict as possible. If a non-strict test is deliberate it might be
wise to comment it as such to avoid confusing it for a mistake.

For testing if a variable is null, it is recommended to use a strict check:
```php
// Faster and easier than is_null() call.
if ($value === null) {
    // ...
}
```

The value to check against should be placed on the right side:
```php
// Yoda style not recommended.
if (null === $this->foo()) {
    // ...
}

// Recommended for better (human) readability.
if ($this->foo() === null) {
    // ...
}
```

### Comparison methods
Consistenty is key here. The project should use one througout the code. In general stick to the short version.

`is_int()` should be used instead of `is_integer()`.
Use `is_writable()` instead of `is_writeable()`.

### Avoid conditional assigment
Especially with not using Yoda conditions one should never use single `=` inside conditions.
So avoid conditional assigments:
```php
// Conditional assigment not recommended.
if (($variable = $this->foo()) === null) {
    // ...
}

// Recommended.
$variable = $this->foo();
if ($variable === null) {
    // ...
}
```

## Whitespace

* Please use "trim-right" in your IDE settings to avoid unnecessary trailing white space.
* Use one newline at the end of the file. This avoids "missing newline" issues in several git hosting
environments
* Always have a single newline at the beginning and end of each class/trait, resulting from a newline
above and below each method.

```php
class Foo extends Bar implements FooInterface
{
    public function foo($a, $b = null)
    {
        // Code here.
    }

    public function bar() {
        // Method body.
    }
}

```

### Inter-Line Alignment
Don't use inter-line alignment. It is

a) Not useful in combination with tabs as indentation (and personal length adjustment of it).
b) Very bad for change diffs, as it creates a lot of noise. It is also additional work.

```php
public function bar()
{
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

### Strings and Concatenation

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
	. ' concatenated';
```

Multi-line control structures should have the parentheses in their own lines (similar to classes and methods):
```php
if (
	($a == $b)
	&& ($b == $c)
	|| (Foo::CONST == $d)
) {
	$a = $d;
}
```

### Careful with deep arrays
One mistake that often gets made:
```php
$foo = [[
	0,
	1, 2
], 3, 4];
```
This would effectively change all lines (and their indentation), if the array structure got normalized.
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
 * @param \Some\Model $Model The model to use.
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
 * @param array|\ArrayObject $array Some array value.
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
$this->doSomething();
```

Comment blocks, with the exception of the first block in a file, should always be preceded by a newline.

### Tags
Recommended tags for each function/method are:

* `@param` if applicable
* `@return`
* `@throws` if applicable
* `@triggers` if applicable

in this order.

Constructors/destructors may not have a `@return` statement,
as they by definition should not return anything.

Additionally these may be useful:

* `@internal` if applicable
* `@see` or `@link`
* `@deprecated` if applicable - using the `@version <vector> <description>` format, where version and description are mandatory.

For PHPUnit:

* `@covers` if applicable
* `@expectedException` if applicable

For additional tags see [phpDocumentator](http://phpdoc.org/).

The `@package` and `@subpackage` annotations are not used.

### Variable types
Variable types for use in DocBlocks:

* `mixed` - A variable with undefined (or multiple) type. Shall be avoided where possible.
* `int` - Integer type variable (whole number).
* `float` - Float/Double/Real type (point number).
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
This is especially important for IDEs, as they otherwise do not support chaining.

Always use FQCN (fully qualified class names) for class names in DocBlocks:
```php
/**
 * Foo function.
 *
 * @param \OtherNamespace\SubNamespace\ClassName|null
 *
 * @return \MyNamespace\MyClass
 */
public function foo(ClassName $class = null) {
    return $this->bar($class);
}
```

## Naming Conventions
- Use namespaces for all classes.
- Suffix interfaces with `Interface`.
- Suffix traits with `Trait`.
- Suffix exceptions with `Exception`.

## Writing better code

* Try to accept and return as few types as possible (mixing integer, boolean, string, array, object etc is usually not too good)
* Try to return early in methods/functions to avoid unnecessary depths

### Example for return early
```php
// Bad.
public function foo($input, $anotherInput = null)
{
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

// Good.
public function foo($input, $anotherInput = null)
{
    if (!$input || !$anotherInput || $anotherInput !== $input) {
        return false;
    }
    // Code.
    return true;
}

```

### Avoid no-op methods
```php
// Bad.
public function foo($input = null)
{
    if ($input === null) {
        return;
    }
    ...
}

// Good.
public function foo($input)
{
    if ($input === null) {
        return;
    }
    ...
}

```
The first would allow no-ops like `$this->foo()` which does not do any operation at all.
So semantically this makes no sense. In this case no default value may be used and a first argument is actually required
for the first if statement to make sense (`$this->foo($requiredArgument)`). You can still pass null, of course, to break out early.
Default values may only be used if their usage does make this method still do an operation (apart from returning early).

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

So it is possible to stick to that useful practice to prefix:
```php
$x = $this->someAttribute;
$x = $this->_someProtectedAttribute;

$this->callToSomeMethod();
$this->_callToSomeProtectedMethod();
```

Note that `__` is also used for magic calls, and as such this recommendation is best used with the above hint of *not* using
private visibility in your code.
Otherwise please disregard and make sure you use an IDE that can display them properly. Using underscores with a lot of
private methods will probably be worse than sticking to the PSR-2 recommendation.

### Return void vs null
`@return void` shall be used to document when a method is expected not to return anything, and when there is just a `return;` as "early return". Explicitly returning with `return null;` or `return $this->foo();` shall be documented be as `@return null` etc.

```php
/**
 * @param string $input
 * @return void
 */
public function setFoo($input)
{
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
public function get($var)
{
    if (!isset($this->config[$var]) {
        return null;
    }

    return $this->config[$var];
}
```
Mixing void and other types must not be used, as a method cannot be expected to return and not return at the same time. Use `null` here instead: `@return \MyObject|null`.

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

Both with lowercase characters (although classes are not case-sensitive, id's are!), the separator is minus [-].
You can use underscore [_] if it makes the separation of the identifier and the record id easier. E.g. `my-id_33`.
It will become necessary to do so if you use UUIDs (which contain minus chars).

Note: ids should be unique on the current page - so don't use them for iterating elements.
In general all styling should be class based. Ids are often abused for that.
But they usually serve the purpose of being identifiable via JS.
So they should ideally be mainly used for dynamic JS scripts.

Do not name the fields after their style, but after the function/meaning - as the style
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

### JS
Ideally, JS related classes are prefixed with `js-` to separate them from the rest of the CSS and styling related class names:
```html
<div class="js-widget-toggle some-styling-class">...</div>
```

## Further considerations
While so far the main focus was on the developer (readability), there are some additional optional guidelines that can help to further reduce diff size on code modification (maintainability).
Those can and should be automated, though, as there is no point in forcing the developer to take care of those manually.

The main idea is to keep each line independant from the others so removing or adding lines has minimal impact.

### Multi-line arrays
Arrays that span across multiple lines can have a trailing comma to make sure that adding new rows does not change the previous row, as well.
```php
$array = [
    'first',
    'second', // Note the trailing comma
];
```

### Multi-line logic
For longer logic (method calls, operations) it can be helpful to put the trailing semicolon at the next line. Especially for fluid programming this will not show the previous row as modified.

```php
$Object
    ->doFirst()
    ->doSecond()
;
```
This would also be consistent to the symmetric bracket placing in general.

