# SvgIcon plugin for CakePHP 4.x

![Build Status](https://github.com/loadsys/cakephp-svg-icon/actions/workflows/ci.yml/badge.svg?branch=main)

This plugin offers an easy way to display SVG icons, with options to customize and/or cache them. It's packaged as a trait that can be used anywhere in your app, with a helper (using the trait) for convenience and caching.

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require loadsys/cakephp-svg-icon
```

## Configuration

Icons should be added to `config/app_svg_icon.php` - see the example included in `config` directory for the expected format. Any SVG icon should work, such as [heroicons](https://heroicons.com) or [Bootstrap Icons](https://icons.getbootstrap.com).

Icons will be cached using the `default` cache config. This can be changed by supplying a different cache config when loading the helper:

``` php
/*
 * src/View/AppView.php
 */
public function initialize(): void
{
    $this->loadHelper('SvgIcon.SvgIcon', [
        'cacheConfig' => 'svg_icon',
    ]);
}
```

This example would use the `svg_icon` cache config, which can be set in `config/app/php`:

``` php
/*
 * Optional configuration settings for the SvgIcon plugin cache
 */
'svg_icon' => [
    'className' => FileEngine::class,
    'prefix' => 'svg_icon_',
    'path' => CACHE . 'views' . DS,
    'duration' => '+1 years',
    'url' => env('CACHE_DEFAULT_URL', null),
]
```

## Usage

Configured icons can be displayed by name - here's an example based on the names used in the sample `config/app_svg_icon.php`.

``` php
<?= $this->SvgIcon->get('heroicon.home') ?>
<?= $this->SvgIcon->get('bootstrap.bi-house') ?>
```

To change default icon attributes, options can be provided:

``` php
<?= $this->SvgIcon->get('heroicon.home', [
  'class' => 'text-gray-300 h-9 w-9',
  'stroke-width' => '2',
]) ?>
```

Note that attribute overrides apply only to the `svg` tag and not it's child `path` tag.
