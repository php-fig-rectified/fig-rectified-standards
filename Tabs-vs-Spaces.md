# Tabs vs Spaces

The holy war of tabs-advocates vs space-gods.

## Pro Arguments for Tabs!
Ordered by priority:

### Less mistakes
Tabs allow for fewer (and easier to spot) indentation mistakes (think about 3 or 5 spaces instead of 4).

### Configurable Indentation Preferences
Each developer can configure his environment to use a specific tab width he is used to. He does not
have to adjust to a team's preference when switching teams. This helps productivity as consistent
behavior helps speed up recognition.

### Smaller File Sizes
Sure, disk space itself doesn't matter, but bandwidth does, so the view files that contain a lot of indentation are effected the most here.
If you take a look, most websites actually still don't compress their output.

### Cursor/Usability
Easier keyboard navigation for starters.
It may seem minor, but positioning the text cursor with the mouse at the beginning of the line is
really annoying when indentation is made of spaces! Pro-spaces would reply: "use home". No kidding.

### Readability
It is hard to grasp the indentation level with lots of spaces, it is way easier with counting 1-x tabs.

### Fewer Key Strokes
For spaces Inc/Dec needs special editors.
Without a proper editor you will kind of kill your space key on the keyboard (and your thumb along with it) in no time.
SHIFT+TAB for decrementing indentation made of spaces does not work in every editor around there (for example, Aptana 2 does not handle it by default, you would have to add a plugin for that probably) - if we start to make this an IDE war.
So in the end it's just so much easier everywhere to use a single char here.

Also, often times, you find the need to open/edit a file without the space-handling IDE, e.g. when using
a GIT diff viewer or some other tool that does not have te full IDE spectrum.
In those cases, if you only want to add something pretty quick, the programs force you to
type 4x the amount and to hit the keyboard space-key like crazy.
Using tab is supported across all applications and programs - and works as expected.

### Details
A more detailed list [here](http://base.thomashigginbotham.com/tabs-vs-spaces-why-is-there-a-debate/).

## Pro Arguments for Spaces?
To be fair, the spaces as indentation is usable. But is that enough?

Some people try to defend its usage with the following arguments:
- Inter-line alignment possible.
- The same on each editor.
- Line length easier to uphold.

But then again, inter-line alignment is a bad practice with near-to-null advantage
but with a huge disadvantage: Additional noise in change diffs/patches and possibly more conflicts/work.

The editor must really be some akward and ancient one, these days.
It's nearly impossible to screw up tabbed code.

Line length regarding a few characters more or less doesn't matter.
That's really a non-issue. Also, most modern editors count the indentation tabs as
`tab-width * amount of tabs`, resulting in exactly the same line length as with spaces.
If you feel like it is an issue, you could just as well force your developers to use
a fixed tab width of for example 4. That would solve the same thing as using spaces, but with
all the advantages of tabs. Win-Win.

## Result
We are easily able to bust the space arguments, leaving only tons of issues if you don't
use the proper tab indentation.
Actually, we even extracted a huge issue in spaces and inter-line aligment (which they always use as pro argument), and can make this
one of *the* biggest argument against spaces:

### Spaces and its inter-line aligment is a bad idea
Tabs prevent you from alignment (there it really doesn't make sense as they usually list as a contra tab argument) and as bonus:
- Way less refactoring work, when changing the alignment of an aligned block because of one single line.
- You have diffs/patches which are much nicer to review (less noise).
- You will minimize the chance to have conflicts, whether it’s with other patches created before that kind of changes to happen or with others that already have local and uncommitted changes.
- Blaming files with your VCS, you have the chance to discover the initial of a line much more directly.

### Why spaces then?
So why sticking to it? Rationally, there is no reason.
In the end it is what it is: People stick to what they are used to.
They are used to spaces, so they cling on to it for the last 25 years, no matter
how wrong that may be these days. It would cost them a `str_place()` call to move on, but that won't happen.

And with FIG and it's PSR as "de-facto" standard now things only got worse, as it is now written in stone that
nothing should change.
The discussion back then can be found [here](https://github.com/php-fig/fig-standards/pull/91) and [here](https://github.com/php-fig/fig-standards/pull/35).

FIG already swallowed 70% of the PHP projects, the remaining 30% using tabs already tumble.
Let's try to stand up for the tabs before they are unrightfully eliminated further.

### Solution!
Join FIG-R and use PSR-2-R. The officially "right" version of indenting code in the 21st century.
