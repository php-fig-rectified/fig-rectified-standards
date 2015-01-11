# PHP Framework Interoperability Group - RECTIFIED

or "FIG-R"

The idea behind the group is to address errors made in the actual FIG PSRs and to rectify those
before it's too late.
~~If other folks want to adopt what we are doing they are welcome to do so, but that is not the aim.~~
If other folks feel forced to adopt what we're doing they are welcome to
do so, and the most certainly will :P Right?

## Why FIG-R and PSR-2-R?
Because it seems to be necessary.

First of all FIG itself did make mistakes in their drafts resulting in a wrong standard now.
They knew it and always talked it down as "internal group decisions" not affecting the rest of the PHP
world. But they very well knew it would at some point, as more and more adopt to it due to a lack
of guidance making it the "de-facto standard" these days.

People are not taking a library, framework or code seriously these days, just because
it is not complying to FIG PSR(-2), by using tabs for example (as it might always have and as it should have).
This addresses this issue in the PHP community.

## Content

- [PSR-2-R](PSR-2-R-coding-style-guide.md) - "PSR-2 with tabs and consistent brace style"
- [PSR-2-R Additions](PSR-2-R-coding-style-guide-additions.md) - optional coding standard recommendations
- [Reasoning](Reasoning.md) behind it and a Spaces-vs-Tabs and Brace-Styles evaluation

### Badge
[![Coding Standards](https://img.shields.io/badge/cs-PSR--2--R-yellow.svg)](https://github.com/php-fig-rectified/fig-rectified-standards)

You can copy this snippet:
```
[![Coding Standards](https://img.shields.io/badge/cs-PSR--2--R-yellow.svg)](https://github.com/php-fig-rectified/fig-rectified-standards)
```

### PHP Standard Recommendations

| Num | Title                         | Code        |
|:---:|-------------------------------|-------------|
| 0   | [Autoloading Standard][psr0]  | PSR-0       |
| 1   | [Basic Coding Standard][psr1] | PSR-1       |
| 2   | [Coding Style Guide][psr2]    | **PSR-2-R** |
| 3   | [Logger Interface][psr3]      | PSR-3       |
| 4   | [Autoloading Standard][psr4]  | PSR-4       |

[psr0]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
[psr1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[psr2]: PSR-2-R-coding-style-guide.md
[psr3]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
[psr4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

## TODOs

- PHPCS-Fixer CodeSniffer branch for this - currently there is [this](https://github.com/dereuromark/codesniffer-standards) and [this](fixer/README.md).
- Undeceive more lost souls. If everyone used PSR-2-R, FIG would have to revise their standard.
- Help to make the FIG people understand what errors they made (and as a result damage they caused by deliberately forming an inconsistent standard) and how they can rectify them.

## Proposing a Standard Recommendation

See the original [FIG] repo.

[FIG]: https://github.com/php-fig/fig-standards
