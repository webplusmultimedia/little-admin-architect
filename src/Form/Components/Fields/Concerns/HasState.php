<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasState
{
    protected mixed $state = null;

    protected ?Field $parentField = null;

    protected ?Closure $afterStateUpdated = null;

    public function getState(): mixed
    {
        if (null === $this->state) {
            if ($this->checkRelation()) {
                return $this->getRelationState();
            }

            return data_get($this->livewire, $this->getStatePath());
        }

        return $this->state;
    }

    public function state(mixed $state): void
    {
        $this->state = $state;
        data_set($this->livewire, $this->getStatePath(), $state);
    }

    public function setState(mixed $value): void
    {
        $this->state = $value;
        if (null === $this->parentField) {
            $this->state($value);
        }
    }

    public function afterStateUpdated(Closure $afterStateUpdated): static
    {
        $this->afterStateUpdated = $afterStateUpdated;

        return $this;
    }

    public function afterStateUpdatedUsing(): void
    {
        if ($this->afterStateUpdated) {
            $this->evaluate($this->afterStateUpdated, ['get']);
        }
    }

    protected function getRelationState(): mixed
    {
        if (null === data_get($this->livewire, $this->getStatePath(), null)) {
            if ($this->record->{$this->name}) {
                if (HasMany::class !== $this->getRelationType()) {
                    return $this->record->{$this->name}->modelKeys();
                }

                return $this->record->{$this->name};
            }
            throw new Exception('Call to a non existing relationship [' . $this->relationship . '] on Select field [' . $this->name . ']');
        }

        return data_get($this->livewire, $this->getStatePath());
    }

    public function setParentField(?Field $parentField): void
    {
        $this->parentField = $parentField;
    }
}
