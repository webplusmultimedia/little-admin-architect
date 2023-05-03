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

    public string $view = 'form::form';
    protected Model $model;

    public function __construct(
        public string $title,
        protected string $method = 'POST',
        protected ?string $action = null,
        protected array|object|null $bind = null,
    ) { }
    static public function make(string $title='',?string $action=null): static
    {
        return  new static(title: $title,action: $action);
    }
    public function getMethod(): string
    {
        return $this->method;
    }
    public function method(string $method): Form
    {
        $this->method = $method;

        return $this;
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
}
