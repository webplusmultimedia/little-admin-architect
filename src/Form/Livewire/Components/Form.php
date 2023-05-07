<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanGetRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanValidatedValues;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasButton;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasSchema;

final class Form
{
    use HasButton;
    use HasSchema;
    use HasColumns;
    use CanGetRules;
    use CanValidatedValues;

    protected string $view = 'form';

    protected ?Model $model = null;

    protected ?string $mode = null;

    protected ?string $action = null;

    protected ?string $livewireId = null;

    public function getLivewireId(): ?string
    {
        return $this->livewireId;
    }

    public function livewireId(string $id): void
    {
        $this->livewireId = $id;
    }

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
