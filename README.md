# Table of contents:

## attributes.php
If callback returns `string` then new content will be returned with updated attribute, otherwise content will be unchanged.

```php
manage_attribute( string $content, string $attribute, function $callback )
```
#### Usage:

```php
$content = manage_attribute($content, "title", function($attr) {
    return "Hello World!";
});
```

#### Shorthand Methods:
More than one class may be added at a time, separated by a space.

```php
add_class( string $content, string $class )
remove_class( string $content, string $class )
```

## slice-tag.php
**Important!** pass `$tag` as a `tagName` between opening and closing sign, eg.`<tag>` or `[tag]`. Returns an `array` of strings, each of which is a sibling of tag in certain level specified by `$depth`. Deeper tags are returned inside their parents.

```php
slice_tag( string $tag, string $content [, int $depth = 0] )
```
[demo](http://bartoszlorek.pl/run/php-content/slice-tag.php)

## heading-hierarchy.php
```php
get_heading_hierarchy( string $content [, int $depth = 0] )
the_heading_hierarchy( string $content [, int $depth = 0] )
```
