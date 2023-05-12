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

    protected string $view = 'checkboxlist';

    public function getWireName(): string
    {
        return $this->prefixName . '.' . $this->name . '*';
    }

    /*  public function interactWithRules(array $rules, ?Model $model = null): array
      {
          $rules['data.' . $this->name . '*'] = $this->rules;

          return $rules;
      }

      public function applyAttributesRules(array $rules): array
      {
          $rules['data.' . $this->name . '*'] = str($this->getLabel())->lower();

          rern $rules;
      }

    /*  public function getValidatedValues(array $values, null|array $datas = null, Model|null $model = null): array
      {
          if ($this->isDisabled()) {
              $model->{$this->name} = $model->getOriginal($this->name);
          } else {
              $values[$this->name] = $model->{$this->name};
          }

          return $values;
      }*/

}
