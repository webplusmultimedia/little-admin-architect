<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ViewErrorBag;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait HasTranslation
{
    protected bool $isTranslate = false;

    protected ?string $translateName = null;

    public function translated(): static
    {
        $this->isTranslate = true;

        return $this;
    }

    public function hasTranslated(): bool
    {
        return $this->isTranslate;
    }

    public function getStatePathForTranslateName(string $lang): ?string
    {
        return $this->translateName . '.' . $lang;
    }

    public function setTranslateName(string $name): void
    {
        $this->translateName = $name;
    }

    public function hydrateRules(array $rules): array
    {
        if ( ! $this->HasTranslated()) {
            return parent::hydrateRules($rules);
        }

        foreach (Form::getTranslatedLangues() as $langue) {
            $translatedRules = ['nullable'];
            foreach ($this->rules as $rule) {
                if ( ! in_array($rule, ['array', 'required'])) {
                    $translatedRules[] = $rule;
                }
                if ('required' === $rule && $langue === Form::getDefaultTranslatedLang()) {
                    $translatedRules[] = $rule;
                }
            }
            $rules['data.' . $this->getName() . '.' . $langue] = $translatedRules;
        }

        $rules['data.' . $this->getName()] = 'array';

        return $rules;
    }

    public function beforeSaveRulesUsing(array $rules): array
    {
        if ( ! $this->hasTranslated()) {
            return parent::beforeSaveRulesUsing($rules);
        }

        return $this->hydrateRules($rules);
    }

    public function applyAttributesRules(array $rules): array
    {
        if ( ! $this->hasTranslated()) {
            return parent::applyAttributesRules(rules: $rules);
        }
        foreach (Form::getTranslatedLangues() as $langue) {
            $rules[$this->getStatePath() . ".{$langue}"] = $this->getAttributes() . "({$langue})";
        }

        return $rules;

    }

    public function getErrorMessage(ViewErrorBag $errors, string $locale = null): ?string
    {
        if ( ! $this->hasTranslated()) {
            return parent::getErrorMessage(errors: $errors, locale: $locale);
        }

        $errorBag = $this->getErrorBag($errors);
        $errorKey = $this->getStatePath();
        foreach (Form::getTranslatedLangues() as $langue) {
            if ($rawMessage = $errorBag->first($errorKey . ".{$langue}")) {
                return $rawMessage;
            }
        }

        return $errorBag->first($this->getStatePath());
    }

    public function getValidatedValues(array $values, array $datas = null, Model $model = null): array
    {
        if ( ! $this->hasTranslated()) {
            return parent::getValidatedValues(values: $values, datas: $datas, model: $model);
        }
        $path = str($this->name)->beforeLast('-translations');

        data_set($values, $path->toString(), $this->getState());
        data_set($datas, $path->prepend('data.')->toString(), $this->getState());
        data_set($this->livewire, $path->prepend('data.')->toString(), $this->getState());
        data_forget($values, $this->name);
        data_forget($this->livewire, $this->getStatePath());

        return $values;
    }

    public function isRequired(): bool
    {
        if($this->hasTranslated() and  Form::getDefaultTranslatedLang()!==Form::getSelectedTranslateLangue()){
            return false;
        }
        return $this->evaluate($this->required);
    }
}
