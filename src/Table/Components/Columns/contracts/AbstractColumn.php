<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasRecord;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasSortable;

abstract class AbstractColumn
{
    use HasSortable;
    use HasLabel;
    use HasRecord;

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
    public function getComponentView(string $view): string
    {
        return config('little-admin-architect.blade-table-prefix') . '::' . $view;
    }
}
