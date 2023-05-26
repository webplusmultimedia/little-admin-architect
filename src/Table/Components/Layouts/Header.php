<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

final class Header
{
    private string $view = 'layouts.header';

    public function __construct(protected AbstractColumn $column)
    {
    }

    public static function make(AbstractColumn $column): Header
    {
        return new self($column);
    }

    public function getComponentView(): string
    {
        return config('little-admin-architect.blade-table-prefix') . '::' . $this->view;
    }

    public function getName(): string
    {
        return $this->column->getName();
    }

    public function isSortable(): bool
    {
        return $this->column->isSortable();
    }

    public function getLabel(): ?string
    {
        return $this->column->getLabel();
    }

  /*  public function getRecord(): Model
    {
        return $this->record;
    }*/
}
