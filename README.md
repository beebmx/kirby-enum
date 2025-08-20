<p align="center">
<a href="https://github.com/beebmx/kirby-enum/actions"><img src="https://img.shields.io/github/actions/workflow/status/beebmx/kirby-enum/tests.yml?branch=main" alt="Build Status"></a>
<a href="https://packagist.org/packages/beebmx/kirby-enum"><img src="https://img.shields.io/packagist/dt/beebmx/kirby-enum" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/beebmx/kirby-enum"><img src="https://img.shields.io/packagist/v/beebmx/kirby-enum" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/beebmx/kirby-enum"><img src="https://img.shields.io/packagist/l/beebmx/kirby-enum" alt="License"></a>
</p>

# Enum for Kirby

`Enum` adds the ability to display and set enumeration content in the panel.

![Enum example](/.github/assets/banner.jpg)

****

## Overview

- [1. Installation](#installation)
- [2. Field properties](#field-properties)
- [3. Usage in templates](#usage-in-templates)
- [4. License](#license)
- [5. Credits](#credits)

## Installation

### Download

Download and copy this repository to `/site/plugins/kirby-enum`.

### Composer

```
composer require beebmx/kirby-enum
```

## Field properties

| Name |  Type  | Default  | Description                                                     |
|:-----|:------:|:--------:|:----------------------------------------------------------------|
| as   | string | `select` | Set the field you want to display and manipulate the enum data. |
| enum | string |  `null`  | Set the namespace of the `enum` to populate the field.          |


### Example

```yaml
fields:
  enum:
    label: Status
    type: enum
    enum: App\Enums\Status
```

> [!NOTE]
> When you reference an `enum` it must be a fully qualified class name,
> should be available with a namespace.

An `enum` class can be defined like this:

```php
namespace App\Enums;

enum Status: string
{
    case Inactive = 'inactive';
    case Active = 'active';
    case Archived = 'archived';
}
```

### Displaying field

When you use an `enum` field, it's just a wrapper around some `Kirby` fields. By default, it will display the value as a `select` field,
but you can change this behavior by setting the `as` property in your blueprint:

```yaml
fields:
  enum:
    label: Status
    type: enum
    enum: App\Enums\Status
    as: radio
```

Here's the list of the available options for the `enum` field:

- [Checkboxes](https://getkirby.com/docs/reference/panel/fields/checkboxes)
- [Multiselect](https://getkirby.com/docs/reference/panel/fields/multiselect)
- [Radio](https://getkirby.com/docs/reference/panel/fields/radio)
- [Select](https://getkirby.com/docs/reference/panel/fields/select)
- [Tags](https://getkirby.com/docs/reference/panel/fields/tags)
- [Toggles](https://getkirby.com/docs/reference/panel/fields/toggles)

> [!NOTE]
> You can set fields properties of every field to customize the behavior of the `enum` field.

### Labels

By default, the text displayed in the options will be the `name` of the `enum case`, but you can customize this by implementing `HasLabel` interface in your `enum` class:

```php
namespace App\Enums;

use Beebmx\KirbyEnum\Contracts\HasLabel;

enum Network: string implements HasLabel
{
    case Facebook = 'facebook';
    case Instagram = 'instagram';
    case TikTok = 'tiktok';
    case Mastodon = 'mastodon';

    public function toLabel(): string
    {
        return match ($this) {
            self::Facebook => 'Facebook network',
            self::Instagram => 'Instagram network',
            self::TikTok => 'TikTok network',
            self::Mastodon => 'Mastodon network',
        };
    }
}
```

## Usage in templates

`Enum` comes with a convenient field method to retrieve the proper `enum case` in your templates.

```php
<?php

$status = $page->enum()->toEnum();

$status->value; // 'active'
$status->name; // 'Active'
```

If you have implemented custom methods in your `enum` class, you can call them as well:

```php
<?php

$network = $page->network()->toEnum();

$network->toIcon();
```

## License

Licensed under the [MIT](LICENSE.md).

## Credits

- Fernando Gutierrez [@beebmx](https://github.com/beebmx)
- [All Contributors](../../contributors)
