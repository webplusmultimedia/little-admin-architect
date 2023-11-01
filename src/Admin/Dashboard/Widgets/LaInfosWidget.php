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
 * Date: 31/10/2023 18:17
 */

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Dashboard\Widgets;

use Webplusmultimedia\LittleAdminArchitect\Admin\Widgets\Widget;

class LaInfosWidget extends Widget
{
    protected array $cachedStats;

    protected string $label = 'Little Admin Architect :: Made by webplus Multimédia';

    protected static string $view = 'little-views::dashboard.widgets.infos-la';

    protected function getViewData(): array
    {
        return [
            'label' => $this->label,
            'description' => 'Système de gestion d\'une Administration.',
        ];
    }
}
