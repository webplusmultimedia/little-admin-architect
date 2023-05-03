<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Closure;
use Illuminate\Validation\Rule;

trait HasRules
{
    /**
     * @var array<string|Rule|Closure>
     */
    public array $rules = [];

    protected function addRules(string|Rule|Closure $rules): void
    {
        $this->rules[] = $rules;
    }

    public function rules(string|Rule|Closure $rules): static
    {
        $this->rules[] = $rules;

        return $this;
    }
}
