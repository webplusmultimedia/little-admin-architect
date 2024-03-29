<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

trait HasValidation
{
    protected ?bool $displayValidationSuccess = true;

    protected ?bool $displayValidationFailure = true;

    protected ?string $errorBag = null;

    public function getValidationClass(ViewErrorBag $errors, string $locale = null): ?string
    {
        $errorBag = $this->getErrorBag($errors);
        if ($errorBag->isEmpty()) {
            return null;
        }
        if ($locale && $errorBag->has($this->field->getWireName() . '.' . $locale)) {
            return $this->shouldDisplayValidationFailure() ? ' ring-error-400 !border-error-400' : null;
        }
        if ($errorBag->has($this->field->getWireName())) {
            return $this->shouldDisplayValidationFailure() ? ' ring-error-400 !border-error-400' : null;
        }

        return $this->shouldDisplayValidationSuccess() ? ' ring-success-400 !border-success-400' : null;
    }

    protected function getErrorBag(ViewErrorBag $errors): MessageBag
    {
        if ($this->errorBag) {
            return $errors->getBag($this->errorBag);
        }
        $boundErrorBag = app(FormBinder::class)->getBoundErrorBag();
        if ($boundErrorBag) {
            return $errors->{$boundErrorBag};
        }

        return $errors->getBag('default');
    }

    public function shouldDisplayValidationFailure(): bool
    {
        return config('little-admin-architect.display_validation_failure', true);
    }

    public function shouldDisplayValidationSuccess(): bool
    {
        return config('little-admin-architect.display_validation_success', true);
    }

    public function getErrorMessage(ViewErrorBag $errors, string $locale = null): ?string
    {
        /*if (! $this->shouldDisplayValidationFailure()) {
            return null;
        }*/

        $errorBag = $this->getErrorBag($errors);

        if ($locale) {
            $errorKey = $this->name . '.' . $locale;
            $rawMessage = $errorBag->first($errorKey);

            return $rawMessage ? str_replace(
                str_replace('_', ' ', $this->name) . '.' . $locale,
                __('validation.attributes.' . $this->name) . ' (' . mb_strtoupper($locale) . ')',
                $rawMessage
            ) : null;
        }
        // $_name = str($this->name)->headline()->lower() . ($locale ? ' (' . mb_strtoupper($locale) . ')' : '');

        return $errorBag->first($this->getConfig()->getWireName());
    }
}
