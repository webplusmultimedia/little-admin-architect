<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Actions\Button;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanGetRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanInitDatasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanValidatedValues;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\HasDefaultValue;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\HasFields;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\InteractWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasSchema;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;

final class Form
{
    use CanGetRules;
    use CanInitDatasForm;
    use CanValidatedValues;
    use HasDefaultValue;
    use HasFields;
    use HasGridColumns;
    use HasSchema;
    use InteractWithLivewire;
    use InteractWithPage;

    protected string $view = 'form';

    protected ?Model $model = null;

    protected ?string $mode = null;

    protected string $action = 'save';

    protected string $type = 'submit';

    protected string $caption = 'Enregistrer';

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

    public static function make(string $title = ''): Form
    {
        return new self(title: $title);
    }

    public function getView(): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $this->view;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function getBind(): null|Model
    {
        return $this->bind;
    }

    public function bind(?Model $record = null): void
    {
        $this->bind = $record;
        $this->initDatasFormOnMount($record);
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

    public function getSaveButton(): Button
    {
        return Button::make($this->caption, $this->type, $this->action)->icon('s-check');
    }

    public function getCancelButton(): Button
    {
        return Button::make('Annuler', 'link', $this->linkIndex())->icon('s-arrow-uturn-left');
    }
}
