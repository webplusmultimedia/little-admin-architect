<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder;

trait HasValidation
{
    public function getValidationClass(ViewErrorBag $errors, string|null $locale = null): string|null
    {
        $errorBag = $this->getErrorBag($errors);
        if ($errorBag->isEmpty()) {
            return null;
        }
        if ($locale && $errorBag->has($this->name . '.' . $locale)) {
            return $this->shouldDisplayValidationFailure() ? ' ring-error-400 !border-error-400' : null;
        }
        if ($errorBag->has($this->getNameWithArrayNotationConvertedInto())) {
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
        return $this->displayValidationFailure ?? config('little-admin-architect.display_validation_failure', true);
    }

    public function shouldDisplayValidationSuccess(): bool
    {
        return $this->displayValidationSuccess ?? config('little-admin-architect.display_validation_success', true);
    }

    public function getErrorMessage(ViewErrorBag $errors, string|null $locale = null): string|null
    {
        if (! $this->shouldDisplayValidationFailure()) {
            return null;
        }

        $errorBag = $this->getErrorBag($errors);

        if ($locale) {
            $errorKey = $this->name . '.' . $locale;
            $rawMessage = $errorBag->first($errorKey);

            return $rawMessage ? str_replace(
                str_replace('_', ' ', $this->name) . '.' . $locale,
                __('validation.attributes.' . $this->name) . ' (' . strtoupper($locale) . ')',
                $rawMessage
            ) : null;
        }

        return $errorBag->first($this->getConfig()->getWireName());
    }
}
