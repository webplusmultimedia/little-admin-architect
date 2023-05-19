<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\CanBeSearchable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\CanBeSortable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasDateTimeValue;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasLivewireId;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasMoneyValue;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasRecord;

abstract class AbstractColumn
{
    use CanBeSearchable;
    use CanBeSortable;
    use HasDateTimeValue;
    use HasLabel;
    use HasLivewireId;
    use HasMoneyValue;
    use HasRecord;

    protected string $view = 'text';

    public function __construct(
        protected string $name
    ) {
        $this->setUp();
    }

    protected function setUp(): void
    {
        $this->value = fn (AbstractColumn $column) => $column->record->{$column->getName()};
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    public function getView(): string
    {
        return config('little-admin-architect.blade-table-prefix') . '::columns.' . $this->view;
    }

    public function getComponentView(string $view): string
    {
        return config('little-admin-architect.blade-table-prefix') . '::' . $view;
    }
}
