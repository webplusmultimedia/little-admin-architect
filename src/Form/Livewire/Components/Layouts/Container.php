<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Layouts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasLabel;

class Container extends AbstractLayout
{
    use HasLabel;
    public ?string $name = 'Mon plein';

    public function getValidatedValues(array $values, ?array $datas = NULL, ?Model $model = NULL): array
    {
        $values = array_merge($values,$this->values($datas));
        return $values;
    }
}
