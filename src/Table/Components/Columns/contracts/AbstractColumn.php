<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts;

use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\CanEvaluateFunction;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractsWithEvaluateFunction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\CanBeSearchable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\CanBeSortable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasLivewireId;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasRecord;

abstract class AbstractColumn
{
    use CanBeSearchable;
    use CanBeSortable;
    use CanEvaluateFunction;
    use HasLabel;
    use HasLivewireId;
    use HasRecord;
    use InteractsWithEvaluateFunction;

    protected string $view = 'text';

    final public function __construct(
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

    public function getDefaultParameters(): array
    {
        return ['state' => $this->getState(), 'search' => $this->getSearch(), 'column' => $this, 'record' => $this->getRecord()];
    }
}
