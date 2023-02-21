<?php
declare(strict_types=1);

namespace SvgIcon\View\Helper;

use Cake\Cache\Cache;
use Cake\View\Helper;
use SvgIcon\Lib\SvgIconTrait;

/**
 * SvgIcon helper
 */
class SvgIconHelper extends Helper
{
    use SvgIconTrait;

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    /**
     * Icon getter and modifier (if $options exist).
     *
     * @param string $name The name of the icon
     * @param array $options Optional SVG attributes to modify
     * @return string The SVG icon or an empty string
     */
    public function get(string $name, array $options = []): string
    {
        $cacheConfig = $this->getConfig('cacheConfig') ?? 'default';
        $cacheNameOptions = $options ? md5(serialize($options)) : '';
        $cacheName = "{$name}-{$cacheNameOptions}.svg";

        $icon = Cache::read($cacheName, $cacheConfig);
        if ($icon === null) {
            $icon = $this->getSvgIcon($name, $options);
            Cache::write($cacheName, $icon, $cacheConfig);
        }

        return $icon;
    }
}
