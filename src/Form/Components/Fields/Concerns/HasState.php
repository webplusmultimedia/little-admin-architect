<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;
use Exception;

trait HasState
{
    protected mixed $state = null;

    protected ?Closure $afterStateUpdated = null;

    public function getState(): mixed
    {
        if ( ! $this->state) {
            if ($this->checkRelation()) {
                return $this->getRelationState();
            }
            /*if (is_array($this->record)) {
                return data_get($this->livewire, $this->getName(), null);
            }*/
            return data_get($this->livewire, $this->getStatePath());
        }

        return $this->state;
    }

    public function state(mixed $state): void
    {
        $this->state = $state;
        /*if (is_array($this->record)) {
            data_set($this->livewire, $this->getName(), $state);
        }*/
        data_set($this->livewire, $this->getStatePath(), $state);
    }

    public function setState(mixed $value): void
    {
        $this->state = $value;
        $this->state($value);
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
        if ( ! isset($this->livewire->record[$this->getName()])) {
            if ($this->record->{$this->name}) {
                return $this->record->{$this->name}->modelKeys();
            }
            throw new Exception('Call to a non existing relationship [' . $this->relationship . '] on Select field [' . $this->name . ']');
        }

        return data_get($this->livewire, $this->getStatePath());
        // return $this->livewire->record[$this->name];
    }
}
