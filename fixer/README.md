# PHP-CS-Fixer version for PSR-2-R

## Install
Drop the `.php_cs` (+ additions) file into your ROOT project dir (where your `composer.json` is) and
put the freshly downloaded `php-cs-fixer.phar` from [FriendsOfPHP/PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
in there along with it.

You might want to adjust the `->exclude()` calls to fit your application/project.

## Usage
You should then be able to run:

    php php-cs-fixer.phar [command] --config-file=.php_cs

You can also add a custom path to run, but note that this would
render the custom finder and its excludes useless:

    php php-cs-fixer.phar [command] --config-file=.php_cs /path

See `-h` for help and what commands are available, e.g. `fix` to run the fixer.

## Fixes
- UseTabs (instead of "indentation")
- ConsistentBraces (instead of "braces")
- PhpdocIndent ("phpdoc_indent" was broken so far)

## Addons
- NoSpacesCast
- ShortCast
- IsInt
- IsWritable
- ConditionalExpressionOrder
- Phpdoc
- CommaSpacing

## TODOs

- Cleanup (maybe into small files)
- Add tests
