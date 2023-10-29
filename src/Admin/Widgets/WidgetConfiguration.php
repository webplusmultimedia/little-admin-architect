<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 *
 * @category    Category
 *
 * @author      daniel
 *
 * @link        http://webplusm.net
 * Date: 29/10/2023 11:21
 */

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Widgets;

class WidgetConfiguration
{
    /**
     * @param  class-string<Widget>  $widget
     * @param  array<string, mixed>  $properties
     */
    public function __construct(
        readonly public string $widget,
        readonly public array $properties = [],
    ) {
    }
}
