<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasOptions;

class CheckBoxList extends Field
{
    use HasOptions;
    use HasGridColumns;

    protected string $view = 'check-box-list';

    public function initDatasFormOnMount(?Model $model): void
    {
        if ($model) {
            if ($model->{$this->name} === NULL) {
                $model->{$this->name} = [];
            }
        }
    }
}
