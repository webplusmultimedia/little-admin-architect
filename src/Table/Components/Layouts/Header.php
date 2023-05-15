<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Concerns\HasLabel;

final class Header
{
    use HasLabel;

    protected string $view = 'layout.header';
    protected Model $record;
    public function __construct(protected string $name, protected bool $sortable = false, protected string $direction = 'asc') {}

    public static function make(string $name, bool $sortable = false, string $direction = 'asc'): Header
    {
        return new static($name, $sortable, $direction);
    }
    public function getComponentView(): string
    {
        return config('little-admin-architect.blade-table-prefix') . '::' . $this->view;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function getRecord(): Model
    {
        return $this->record;
    }
}
