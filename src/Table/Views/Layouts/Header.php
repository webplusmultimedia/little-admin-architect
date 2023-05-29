<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Views\Layouts;

use Webplusmultimedia\LittleAdminArchitect\Table\Views\Layouts\Contracts\AbstractComponent;

class Header extends AbstractComponent
{
    protected string $viewPath = 'layout.header';

    public function __construct(
        protected \Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header $header,
        protected ?string $sortColumn,
        protected ?string $sortDirection
    ) {
    }

    public function getHeader(): \Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header
    {
        return $this->header;
    }

    /**
     * @return string
     */
    public function getSortColumn(): ?string
    {
        return $this->sortColumn;
    }

    /**
     * @return string
     */
    public function getSortDirection(): ?string
    {
        return $this->sortDirection;
    }
}
