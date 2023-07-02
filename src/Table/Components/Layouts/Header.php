<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

final class Header implements Htmlable
{
    private string $view = 'layouts.header';

    private ?string $sortDirection = null;

    private ?string $sortColumn = null;

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

    public function render(): View
    {
        return view('little-views::table-components.layout.header', ['header' => $this, 'sortColumn' => $this->sortColumn, 'sortDirection' => $this->sortDirection]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function sortDirection(?string $sortDirection): Header
    {
        $this->sortDirection = $sortDirection;

        return $this;
    }

    public function sortColumn(?string $sortColumn): Header
    {
        $this->sortColumn = $sortColumn;

        return $this;
    }
}
