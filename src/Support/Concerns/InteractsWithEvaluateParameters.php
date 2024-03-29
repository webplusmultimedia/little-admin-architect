<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Concerns;

use Closure;
use Exception;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;

trait InteractsWithEvaluateParameters
{
    protected function set(): Closure
    {
        return function (string $name, mixed $value): void {
            if ($this->livewire instanceof BaseForm) {
                $field = $this->livewire->form->getFormFieldByName($name);
                if ($field) {
                    $field->state($value);
                }
            }
        };
    }

    protected function get(): Closure
    {
        return function (string $name) {
            if ($this->livewire instanceof BaseForm) {
                $field = $this->livewire->form->getFormFieldByName($name);
                if ($field) {
                    return $field->getState();
                }
            }
            throw new Exception('Field [' . $name . '] not exist.');
        };
    }
}
