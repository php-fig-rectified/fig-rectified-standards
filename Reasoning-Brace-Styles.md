# Brace styles
- Allman: Opening braces on next line
- 1TBL (One True Brace Style): Opening braces on the same line

Another holy war on its own.

- Allman: Opening braces on next line
- 1TBL (One True Brace Style): Opening braces on the same line

## Remove inconsistency of FIG PSR-2
The main problem many have with PSR-2 is that it uses inconsistent brace positioning:
- classes, methods: Allman - Opening braces on next line
- conditions, trait: 1TBL - Opening braces on the same line

That inconsistency would be resolvable by either
- using Allman consistently
- using 1TBL consistently

At this point both would be totally fine as standard basis.

## Allman vs 1TBL
So the question is: All same or all new line?

The FIG people claim that the different bracing style for control structures vs blocks are a justifyable trade-off.
They acknowledge the fact that using Allman style for conditions doesn't make sense, as the increase of line length would be too much.
But for methods and classes they claim that this way you can at least see where they start and end:
```php
public function foo($bar)
{
	...
}
```
Using a line-length limit of 80-120 chars, this is kind of bogus to argument, though, as indentation already takes care of that:
```php
public function foo($bar) {
	...
}
```

It is still very easy to see both beginning and end.
Especially since this inferior bracing style needs **two** lines before jumping into the next indenation level (nested body).

Compare Allman (pseydo syntax):
```php
X
X
	Y
	Y
X
```

With 1TBL (pseydo syntax):
```php
X
	Y
	Y
X
```
As one can clearly see, the single line is totally enough.

As for methods, compare:
```php
class Foo extends Bar implements FooInterface
{
	public function sampleFunction($a, $b = null)
	{
		if ($a === $b)
		{
			bar();
		}
		elseif ($a > $b)
		{
			$foo->bar($arg1);
		}
		else
		{
			BazClass::bar($arg2, $arg3);
		}
	}

	final public static function bar()
	{
		// method body
	}
}
```

with:
```php
class Foo extends Bar implements FooInterface {

	public function sampleFunction($a, $b = null) {
		if ($a === $b) {
			bar();
		} elseif ($a > $b) {
			$foo->bar($arg1);
		} else {
			BazClass::bar($arg2, $arg3);
		}
	}

	final public static function bar() {
		// method body
	}

}
```

Even with additional newlines before and after each method, the second one reads cleaner and better - or at least
just as good - without taking that much screen height.

And mixing them (as FIG proposes) is out of the question as its inconsistent and doesn't make sense.
So the second (opening brace at the end of the SAME line) one is recommended.

Also note that you can use the additional vertical space won, to "smartly" group with additional newlines now.
E.g. in logical blocks. That further enhances the readability.

Note that for multiline statements, it needs a newline after the class declaration and newlines for method arguments:
```php
class Foo
	extends Bar
	implements FooInterface {

	public function sampleFunction(
		$a,
		$b = null
	) {
		...
	}

}
```

## Another inconsistency inside PSR-2: Multiline
PSR-2 is even inconsistent inside the method declaration itself.

Single line statements in PSR-2 would be:
```php
public function sampleFunction($a, $b = null) 
{
	...
}
```
Intuitively you would expect the curly brackets to be always on a new line:
```php
public function sampleFunction(
	$a, 
	$b = null
) 
{
	...
}
```

But in fact for multiline statements, it suddenly behaves like PSR-2-R does:
```php
public function sampleFunction(
	$a,
	$b = null
) {
	...
}
```
Why not then using *a* consistent way of doing it right away?
