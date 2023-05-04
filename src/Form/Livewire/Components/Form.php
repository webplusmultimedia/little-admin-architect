<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasButton;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasSchema;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Illuminate\Database\Eloquent\Model;

final class Form
{
    use HasButton;
    use HasSchema;

    protected string $view = 'form';
    protected Model $model;
    protected string $mode;
    protected string $action;

    public function __construct(
        public string               $title,
        protected array|object|null $bind = NULL,
    )
    {

    }

    static public function make(string $title = ''): static
    {
        return new static(title: $title);
    }

    public function getView()
    {
        return config('little-admin-architect.blade-prefix') . '::' . $this->view;
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

    public function getBind(): object|array|null
    {
        return $this->bind;
    }

    public function bind(object|array|null $bind): Form
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
            $rules['data.' . $field->name] = $field->rules;
        }

        return $rules;
    }

    public function values(array $datas): array
    {
        $values = [];
        foreach ($datas['data'] as $fieldName => $data) {
            if (! $this->isDisabledField($fieldName)) {
                $values[$fieldName] = $data;
            } else {
                $this->bind->{$fieldName} = $this->bind->getOriginal($fieldName);
            }
        }

        return $values;
    }

    protected function isDisabledField(string $name): bool
    {
        foreach ($this->fields as $field) {
            if ($field->name === $name) return $field->isDisabled();
        }

        return false;
    }

    public function init(): void
    {
        if ($this->bind && $this->bind->exists()){
            $this->mode = 'UPDATED';
        }else {
            $this->mode = 'CREATED';
        }
    }

    public function mode(): string
    {
        return $this->mode;
    }

}
