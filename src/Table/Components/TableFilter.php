<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;

class TableFilter implements Htmlable
{
    protected function __construct(protected array $tableFilters = [])
    {

    }

    public static function make(array $tableFilters = []): TableFilter
    {
        return new self($tableFilters);
    }

    public function hasFilters(): bool
    {
        return count($this->tableFilters) > 0;
    }

    public function getTableFilters(): array
    {
        return $this->tableFilters;
    }

    public function render(): View
    {
        return view('little-views::table-components.table-filters', ['filters' => $this->tableFilters]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
