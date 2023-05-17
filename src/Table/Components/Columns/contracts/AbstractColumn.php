<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasDateTimeValue;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasMoneyValue;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasRecord;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasSortable;

abstract class AbstractColumn
{
    use HasSortable;
    use HasLabel;
    use HasRecord;
    use HasDateTimeValue;
    use HasMoneyValue;

    protected string $view = 'text';
    public function __construct(
        protected string $name
    ) {
       $this->setUp();
    }

    protected function setUp()
    {
        $this->value = fn(AbstractColumn $column) => $column->record->{$column->getName()};
    }
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
