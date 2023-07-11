<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Label extends AbstractComponent
{
    public function __construct(public ?string $label, public ?string $id = null, public bool $showRequired = false, public bool $wrappedWithMargin = true)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'fields.partials.label';
    }

    protected function setUp(Field|AbstractLayout $field): void
    {
        // TODO: Implement setUp() method.
    }
}
