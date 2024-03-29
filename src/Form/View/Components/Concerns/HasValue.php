<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder;

trait HasValue
{
    protected string | int | array | Closure | null $value = null;

    protected array | object | null $bind = null;

    public function getValue(string $locale = null): mixed
    {
        $oldValue = $this->getOldValue($locale);
        if (isset($oldValue)) {
            return $oldValue;
        }
        if ($this->value instanceof Closure) {
            return ($this->value)($locale ?: app()->getLocale());
        }
        $dataBatch = $this->bind ?: app(FormBinder::class)->getBoundDataBatch();

        if ($locale) {
            // Prevent packages like spatie/laravel-translatable to automatically get the current locale
            // value from a model, even if `data_get` is being used.
            if ($dataBatch instanceof Model) {
                return $this->value ?? data_get($dataBatch->toArray(), $this->name . '.' . $locale);
            }

            return $this->value ?? data_get($dataBatch, $this->name . '.' . $locale);
        }

        return $this->value ?? data_get($dataBatch, $this->name);
    }

    protected function getOldValue(?string $locale): mixed
    {
        $oldValue = data_get(old(), $this->name . ($locale ? '.' . $locale : ''));
        if ($oldValue) {
            return $oldValue;
        }

        return array_key_exists($this->name, old(default: [])) ? '' : null;
    }
}
