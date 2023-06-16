<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasOptions;

class CheckBoxList extends Field
{
    use HasGridColumns;
    use HasOptions;

    protected string $view = 'check-box-list';

    public function initDatasFormOnMount(?Model $model): void
    {
        if ($model) {
            if (null === $model->{$this->name}) {
                $model->{$this->name} = [];
            }
        }
    }

    public function getValue(): mixed
    {
        if ($this->getRecord()->{$this->getName()}) {
            return $this->getRecord()->{$this->getName()};
        }

        return [];
    }
}
