<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components;

use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Larastan\Concerns\HasContainer;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasButton;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasSchema;

final class Form
{
    use HasButton;
    use HasSchema;
    use HasColumns;

    protected string $view = 'form';

    protected ?Model $model = null;

    protected ?string $mode = null;

    protected ?string $action = null;


    public function __construct(
        public string $title,
        protected Model|null $bind = null,
    ) {

    }

    public static function make(string $title = ''): static
    {
        return new self(title: $title);
    }

    public function getView(): string
    {
        return config('little-admin-architect.blade-prefix').'::'.$this->view;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(?string $action): Form
    {
        $this->action = $action;

        return $this;
    }

    public function getBind(): Model
    {
        return $this->bind;
    }

    public function bind(Model $bind): Form
    {
        $this->bind = $bind;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function title(string $title): Form
    {
        $this->title = $title;

        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getRules(): array
    {
        $rules = [];
        foreach ($this->fields as $field) {
            $rules['data.'.$field->name] = $field->rules;
        }

        return $rules;
    }

    public function getAttributesRules(): array
    {
        $rules = [];
        foreach ($this->fields as $field) {
            $rules['data.'.$field->name] = str($field->getLabel())->lower();
        }

        return $rules;
    }

    public function values(array $datas): array
    {
        $values = [];
        if ($this->bind instanceof Model){
            foreach ($datas['data'] as $fieldName => $data) {
                if (! $this->isDisabledField($fieldName)) {
                    $values[$fieldName] = $data;
                } else {
                    $this->bind->{$fieldName} = $this->bind->getOriginal($fieldName);
                }
            }
        }


        return $values;
    }

    protected function isDisabledField(string $name): bool
    {
        foreach ($this->fields as $field) {
            if ($field->name === $name) {
                return $field->isDisabled();
            }
        }

        return false;
    }

    public function init(): void
    {
        if ($this->bind && $this->bind->exists()) {
            $this->mode = 'UPDATED';
        } else {
            $this->mode = 'CREATED';
        }
    }

    public function mode(): ?string
    {
        return $this->mode;
    }
}
