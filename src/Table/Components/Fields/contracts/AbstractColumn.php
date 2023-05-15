<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Fields\contracts;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Fields\Concerns\HasSortable;

abstract class AbstractColumn
{
    use HasSortable;

    protected string $view = 'text';
    public function __construct(
        protected string $name
    ) {}

    public function getName(): string
    {
        return $this->name;
    }
    public static function make(string $name, ): static
    {
        return new static($name);
    }

    public function getView(): string
    {
        return config('little-admin-architect.blade-table-prefix').'::columns.'. $this->view;
    }
    protected function getViewComponent(string $view): string
    {
        return config('little-admin-architect.blade-table-prefix') . '::' . $view;
    }
}
