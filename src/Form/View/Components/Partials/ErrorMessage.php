<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class ErrorMessage extends AbstractComponent
{
    public function __construct(public ?string $message)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'fields.partials.error-message';
    }

    protected function setUp(Field | AbstractLayout $field): void
    {
        // TODO: Implement setUp() method.
    }
}
