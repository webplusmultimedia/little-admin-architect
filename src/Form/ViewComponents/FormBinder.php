<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents;

use Illuminate\Support\Arr;

class FormBinder
{
    public function __construct(
        protected array       $boundDataBatches = [],
        protected string|null $errorBagKey = NULL,
        protected array       $livewireModifiers = [],
        protected null|int    $test = NULL
    )
    {

    }

    public function bindNewDataBatch(array|object|null $dataBatch): void
    {
        $this->boundDataBatches[] = $dataBatch;

    }

    public function getBoundDataBatch(): array|object|null
    {

        return Arr::last($this->boundDataBatches);
    }

    public function unbindLastDataBatch(): void
    {
        // array_pop($this->boundDataBatches);
    }

    public function bindErrorBag(string|null $errorBagKey): void
    {
        $this->errorBagKey = $errorBagKey;
    }

    public function getBoundErrorBag(): string|null
    {
        return $this->errorBagKey;
    }

    public function unbindErrorBag(): void
    {
        $this->errorBagKey = NULL;
    }

    public function bindNewLivewireModifier(string|null $livewireModifier): void
    {
        $this->livewireModifiers[] = $livewireModifier ? : '';
    }

    public function getBoundLivewireModifer(): string|null
    {
        return Arr::last($this->livewireModifiers);
    }

    public function unbindLastLivewireModifier(): void
    {
        array_pop($this->livewireModifiers);
    }
}
