<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanInitDatasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasColSpan;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasSchema;

abstract class AbstractLayout /*implements CanValidateValuesForRules, CanGetAttributesRules, CanInteractWithRules*/
{
    use CanInitDatasForm;
    use HasColSpan;
    use HasGridColumns;
    use HasSchema;
    use \Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasForm;

    protected string $view = 'layouts.container';

    protected Model|null $bind = null;

    public function __construct(
        public ?string $title = null,
        int $columns = 2,
    ) {
        $this->columns($columns);
        $this->afterMake();
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

    public function getWireKey(): string
    {
        $title = $this->title ?? Str::random(5);

        return (string) str($title)->append('-', str($title)->kebab());
    }

    public function getFieldView(): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $this->view;
    }

    protected function getViewComponent(string $view): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $view;
    }
}
