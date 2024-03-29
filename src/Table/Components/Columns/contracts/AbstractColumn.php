<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts;

use Exception;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\CanEvaluateParameters;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\CanBeSearchable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\CanBeSortable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasLivewireId;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasRecord;

abstract class AbstractColumn extends Component implements Htmlable
{
    use CanBeSearchable;
    use CanBeSortable;
    use CanEvaluateParameters;
    use HasLabel;
    use HasLivewireId;
    use HasRecord;

    protected string $view;

    final public function __construct(
        protected string $name
    ) {
        $this->setUp();
    }

    protected function setUp(): void
    {
        $this->value = fn (AbstractColumn $column) => data_get($column->record, $column->getName());
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
        if ( ! isset($this->view)) {
            throw new Exception('Class [' . static::class . '] extends [' . static::class . '] but does not have a [$view] property defined.');
        }

        return $this->view;
    }

    protected function getDefaultParameters(): array
    {
        return ['state' => $this->getState(), 'search' => $this->getSearch(), 'column' => $this, 'record' => $this->getRecord()];
    }

    public function render(): View
    {
        return view(
            $this->getView(),
            array_merge(
                ['attributes' => new ComponentAttributeBag()],
                [...$this->data()],
            )
        );
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
