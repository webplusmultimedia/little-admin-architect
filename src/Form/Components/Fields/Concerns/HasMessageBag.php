<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

trait HasMessageBag
{
    protected string|null $errorBag = null;

    public function getErrorMessage(ViewErrorBag $errors, string|null $locale = null): string|null
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

        return $errorBag->first($this->getStatePath());
    }

    protected function getErrorBag(ViewErrorBag $errors): MessageBag
    {
        if ($this->errorBag) {

            return $errors->getBag($this->errorBag);
        }

        return $errors->getBag('default');
    }
}
