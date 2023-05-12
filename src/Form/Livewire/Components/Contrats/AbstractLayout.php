<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanGetRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanValidatedValues;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasColSpan;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasSchema;

abstract class AbstractLayout implements CanValidateValuesForRules, CanGetAttributesRules, CanInteractWithRules
{
    use CanGetRules;
    use CanValidatedValues;
    use HasColSpan;
    use HasGridColumns;
    use HasSchema;

    protected string $view = 'layouts.container';

    protected Model|null $bind = null;

    final public function __construct(
        public ?string $title = null,
        int $columns = 2,
    ) {
        $this->columns($columns);
        $this->afterMake();
    }

    public static function make(?string $title = null, int $columns = 2): static
    {
        return new static(title: $title,columns: $columns);
    }

    protected function afterMake(): void
    {

    }
    public function getBind(): ?Model
    {
        return $this->bind;
    }

    public function bind(Model $bind): static
    {
        $this->bind = $bind;

        return $this;
    }

    public function getFieldView(): string
    {
        return config('little-admin-architect.blade-prefix').'::'.$this->view;
    }

    protected function getViewComponent(string $view): string
    {
        return config('little-admin-architect.blade-prefix').'::'.$view;
    }
}
