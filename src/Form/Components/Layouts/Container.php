<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasLabel;

final class Container extends AbstractLayout
{
    use HasLabel;

    protected string $view = 'container';

    protected string $name = '...';

    protected string $colSpan = 'lg:col-span-full';

    public static function make(?string $title = null, int $columns = 2): Container
    {
        return new self(title: $title, columns: $columns);
    }
}
