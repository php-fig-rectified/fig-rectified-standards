# Reasoning

## Indentation
As outlined before, spaces are for spacing/separation of text. They can be used
for alignment, if required, but that's about it.
Only tabs are - per definition - valid indentation characters.

Abusing 2,4,8 spaces to replace that is a dirty hack from back in the days,
where there weren't any IDEs.
And the fact that the space-god followers have to argue whether to put 2, 4 or 8
spaces (There are even some projects that use 3... Or used to anyway) proves that
only a single tab is the right way to do it.

Any IDE can make a tab as "wide" as you prefer, with spaces this is not that easy.
It can also quickly go wrong.

See [the two answers that should have been checked](http://programmers.stackexchange.com/questions/57/tabs-versus-spaces-what-is-the-proper-indentation-character-for-everything-in-e) for details.

## Brace style

Compare

```php
<?php
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

with

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

## Additions
Many topics have not been addressed in the FIG PSR-2 (which is not a bad thing), but this might leave a void
or indeterminacy. Those recommendations are mainly based on the CakePHP1+2 coding standards (as well as both topics above)
and suit as a very reasonable standard.

## Contributions
Feel free to address any critism or ideas for improvement/enhancement as issue or PR.

See this guide as an alternative to the FIG one, if that one doesn't fit you.
Once we create a critical mass of followers of this "modern standards", I bet some frameworks, that
recently felt forced to throw their very same standards over board and to join FIG, will be back on board.
Making the PHP coding standard again what it should have been for years.


## What FIG *should* have done
The voting members should not have mixed their frameworks's ancient ways of doing things.
That usually leads to inconsistent (as proven by them) guides - and later standards.
Instead, they should have decided reasonably towards a sane standard (tabs + consistent brace style) and
then (quickly or slowly) migrated their code towards this now improved coding standard.
CakePHP could have been such a role model, as they have been using such a standard from the very beginning
(as the very first real PHP framework), so for over 10+ years.
Their vote has been diminished by the other voting members.
