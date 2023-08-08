<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\CanBeBoolean;

class CheckBox extends Field
{
    use CanBeBoolean;

    protected string $view = 'checkbox';

    protected string $type = 'checkbox';

    public function getType(): string
    {
        return $this->type;
    }

    public function switch(): static
    {
        $this->type = 'switch';

        return $this;
    }

    public function applyDefaultValue(): void
    {
        if ( ! data_get($this->livewire, $this->getStatePath())) {
            data_set($this->livewire, $this->getStatePath(), false);
        }
        parent::applyDefaultValue();
    }

    public function initDatasFormOnMount(?Model $model): void
    {
        if ($model) {
            if (null === $model->{$this->name}) {
                $model->{$this->name} = false;
            }
        }
    }
    public function setUp(): void
    {
        $this->setViewDatas('field', $this);
    }
}
