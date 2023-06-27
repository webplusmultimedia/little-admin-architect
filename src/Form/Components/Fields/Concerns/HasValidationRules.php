<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;
use Illuminate\Validation\Rule;

trait HasValidationRules
{
    /**
     * @var array<int,string|Rule|Closure>
     */
    protected array $rules = [];

    protected bool $nullable = false;

    protected function addRules(string|Rule|Closure $rules): void
    {
        $this->rules[] = $rules;
    }

    public function rules(string|Rule|Closure $rules): static
    {
        $this->rules[] = $rules;

        return $this;
    }

    public function exists(string $table, string|null $column = null): static
    {
        $rules = "exists:{$table}";
        if ($column) {
            $rules .= ",{$column}";
        }
        $this->addRules($rules);

        return $this;
    }

    public function nullable(): static
    {
        $this->addRules('nullable');
        $this->nullable = true;

        return $this;
    }

    public function getViewComponentForErrorMessage(): string
    {
        return $this->getViewComponent('partials.error-message');
    }

    protected function isNullable(): bool
    {
        return $this->nullable;
    }
}
