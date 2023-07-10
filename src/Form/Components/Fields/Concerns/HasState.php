<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Model;

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
            if ($this->record instanceof Model) {
                return $this->record->{$this->getName()};
            }
            if (is_array($this->record)) {
                if (isset($this->record[$this->getName()])) {
                    return $this->record[$this->getName()];
                }
            }
        }

        return $this->state;
    }

    public function state(mixed $state): void
    {
        $this->state = $state;
        if ($this->checkRelation()) {
            $this->livewire->record[$this->getName()] = $state; //  @phpstan-ignore-line

            return;
        }
        if ($this->record instanceof Model) {
            $this->record->{$this->getName()} = $state;
        }
        if (is_array($this->record)) {
            $this->record[$this->getName()] = $state;
        }

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
            return $this->record->{$this->getName()}->modelKeys();
        }

        return $this->livewire->record[$this->getName()];

    }
}
