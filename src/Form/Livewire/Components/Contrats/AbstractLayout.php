<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanGetRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasColSpan;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasSchema;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

abstract class AbstractLayout
{
    use HasColumns;
    use HasColSpan;
    use CanGetRules;
    use HasSchema;
    protected string $view = 'layout.grid';
    final public function __construct(
        public string $title,
        int $columns,
    ) {
        $this->columns($columns);
    }

    public static function make(string $title, int $columns = 2): static
    {
        return  new static(title: $title,columns: $columns);
    }

    /**
     * @return array<int,Field>
     */
    abstract protected function schema(): array;

    public function getFieldView(): string
    {
        return config('little-admin-architect.blade-prefix').'::'.$this->view;
    }
    protected function getViewComponent(string $view): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $view;
    }

    public function setUp(null|Model $model): Form
    {
        $form = $this->form($model);
        $form->schema($this->schema());

        return $form;
    }
}
