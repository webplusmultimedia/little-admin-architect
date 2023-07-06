<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Mixins;

use Closure;
use Illuminate\Support\Collection;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

/** @mixin BaseForm */
class SelectMixing
{
    public function getOptionsUsing(): Closure
    {
        return function (string $name) {

            $form = $this->form;
            if ($form->hasOptionsUsing() and isset($form->getListOptionsUsing()[$name])) {
                return call_user_func($form->getListOptionsUsing()[$name]);
            }

            return [];
        };
    }

    public function getSearchResultsUsing(): Closure
    {
        return function (string $name, string $search): array|Collection {
            /** @var Form $form * */
            $form = $this->form;
            /** @var Select $field */
            $field = $form->getFormFieldByPath($name);
            if ($form->hasSearchResultsUsing() and isset($form->getSearchResultsUsing()[$name])) {
                if ($field->hasRelationship()) {
                    return app()->call($form->getSearchResultsUsing()[$name], ['component' => $field, 'search' => $search]);
                }

                return call_user_func($form->getSearchResultsUsing()[$name], $search);
            }

            return [];
        };

    }
}
