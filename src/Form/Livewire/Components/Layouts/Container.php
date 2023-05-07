<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Layouts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasLabel;

class Container extends AbstractLayout
{
    use HasLabel;

    public ?string $name = 'Mon plein';

    public function getValidatedValues(array $values, ?array $datas = null, ?Model $model = null): array
    {
        $values = array_merge($values, $this->values($datas));

        return $values;
    }

    public function applyAttributesRules(array $rules): array
    {
        return array_merge($rules, $this->getAttributesRules());
    }

    public function interactWithRules(array $rules, ?Model $model = null): array
    {
        /** bind model for container **/
        if (! $this->getBind()) {
            $this->bind(bind: $model);
        }

        return array_merge($rules, $this->getRules());
    }
}
