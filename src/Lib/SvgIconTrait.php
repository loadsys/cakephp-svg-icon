<?php
declare(strict_types=1);

namespace SvgIcon\Lib;

use Cake\Core\Configure;
use Cake\Utility\Xml;
use DomDocument;

/**
 * SvgIcon trait
 */
trait SvgIconTrait
{
    /**
     * Icon getter and modifier (if $options exist).
     *
     * @param string $name The name of the icon
     * @param array $options Optional SVG attributes to modify
     * @return string The SVG icon or an empty string
     */
    public function getSvgIcon(string $name, array $options = []): string
    {
        $icon = Configure::read($name);
        if ($icon && $options) {
            $doc = Xml::build($icon, ['return' => 'domdocument']);
            if ($doc instanceof DOMDocument) {
                $svg = $doc->getElementsByTagName('svg');
                if ($svg->length) {
                    foreach ($options as $key => $value) {
                        $svg[0]->setAttribute($key, $value);
                    }
                    $icon = $doc->saveHtml($svg[0]);
                }
            }
        }

        return $icon ?? '';
    }
}
