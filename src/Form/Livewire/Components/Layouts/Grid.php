<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Layouts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasLabel;

final class Grid extends AbstractLayout
{
    use HasLabel;

    protected string $name = '...';
    protected string $colSpan = 'lg:col-span-full';

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
        if ( ! $this->getBind()) {
            $this->bind(bind: $model);
        }

        return array_merge($rules, $this->getRules());
    }
}
