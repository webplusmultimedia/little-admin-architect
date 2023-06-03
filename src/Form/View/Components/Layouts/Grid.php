<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Layouts;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Contracts\AbstractLayoutView;

class Grid extends AbstractLayoutView
{
    public function __construct(
        \Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Grid $field,
        public null|string $name = null,
    ) {
        parent::__construct();
        $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'layouts.grid';
    }

    protected function setUp(AbstractLayout $field): void
    {
        $this->field = $field;
    }
}
