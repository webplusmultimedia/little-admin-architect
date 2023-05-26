<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Wrapper extends AbstractComponent
{
    protected function setViewPath(): string
    {
        return 'fields.partials.wrapper';
    }

    public function __construct(
        public string $id,
    ) {
        parent::__construct();

    }

    protected function setUp(Field $field): void
    {
        // TODO: Implement setUp() method.
    }
}
