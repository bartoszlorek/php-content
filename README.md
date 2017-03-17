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

## split-tag.php
**Important!** pass tag as `<tag>` or `[tag]`. Returns an `array` of strings, each of which is a first-level sibling of tag. Nested tags (next levels) are returned their inside parents.

```php
split_tag( string $tag, string $content )
```

## heading-hierarchy.php
```php
get_heading_hierarchy( string $content [, int $depth = 0] )
the_heading_hierarchy( string $content [, int $depth = 0] )
```
