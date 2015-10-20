<?php
/**
 * PSR-2-R version of PHPCSFixer
 *
 * @link https://github.com/php-fig-rectified/fig-rectified-standards
 * @license MIT
 */

require __DIR__ . '/.php_cs_additions';

$finder = Symfony\CS\Finder\DefaultFinder::create()
	->exclude('vendor')
	->exclude('plugins')
	->exclude('logs')
	->exclude('tmp')
	->exclude('bin')
	->exclude('config/Migrations')
	->name('/\.(?:ctp|php)$/')
	->in(__DIR__);

$config = Symfony\CS\Config\Config::create()
	->finder($finder)
	->level(Symfony\CS\FixerInterface::PSR0_LEVEL)
	->fixers(array(
			// PSR1
			'encoding',
			'short_tag',

			// Symfony and PSR2 (some)
			'include',
			'join_function',
			'namespace_no_leading_whitespace',
			'object_operator',
			'new_with_braces',
			'operators_spaces',
			'standardize_not_equal',
			'ternary_spaces',
			'whitespacy_lines', // too much?
			'unused_use',
			'remove_lines_between_uses',
			'remove_leading_slash_use',
			'spaces_before_semicolon',
			'multiline_spaces_before_semicolon',
			'extra_empty_lines',
			'trailing_spaces',
			'duplicate_semicolon',
			'visibility',
			'php_closing_tag',
			'parenthesis',
			'multiple_use',
			'method_argument_space',
			'lowercase_keywords',
			'lowercase_constants',
			'linefeed',
			'line_after_namespace',
			'function_declaration',
			'eof_ending',
			'function_call_space',
			'elseif',
			//'phpdoc_indent', // broken right now
			'phpdoc_scalar',
			'phpdoc_no_package',
			'phpdoc_no_access',
			'phpdoc_trim',
			'phpdoc_type_to_var',
			'phpdoc_var_without_name',
			'single_quote',

			// Contrib
			'concat_with_spaces',
			'ordered_use',

			// Optional
			'multiline_array_trailing_comma',

			// Custom
			// see below

			// Later
			//'short_array_syntax',

			// Soon
			'single_line_after_imports', // https://github.com/FriendsOfPHP/PHP-CS-Fixer/pull/816

			// Definitely NOT
			//'indentation',
			//'braces',
		));

$config->addCustomFixer(new UseTabsFixer());
//$config->addCustomFixer(new ConsistentBracesFixer()); // Until https://github.com/FriendsOfPHP/PHP-CS-Fixer/pull/935/ is fixed
$config->addCustomFixer(new NoSpacesCastFixer());
$config->addCustomFixer(new ShortCastFixer());
$config->addCustomFixer(new IsIntFixer());
$config->addCustomFixer(new IsWritableFixer());
$config->addCustomFixer(new ConditionalExpressionOrderFixer());
$config->addCustomFixer(new PhpdocFixer());
$config->addCustomFixer(new CommaSpacingFixer());

//FIX
$config->addCustomFixer(new PhpdocIndentFixer());

return $config;
