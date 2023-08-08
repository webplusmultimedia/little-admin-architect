<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\DateTime\HasConfigDateTime;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\DateTime\HasRangeDate;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

class DateTimePicker extends Field
{
    use HasConfigDateTime;
    use HasRangeDate;

    protected string $view = 'date-time-range-picker';

    public function setUp(): void
    {
        $this->setViewDatas('field', $this);
    }

    public function livewire(Component|BaseForm $livewire): void
    {
        parent::livewire($livewire);
        if ($this->getDateFromWireName()) {
            $from = Input::make($this->getDateFromName())->hidden();
            $from->record($this->record);
            $from->livewire($this->livewire);
            $from->statusForm($this->statusForm);
            if ( ! $this->isHiddenOnForm()) {
                Form::addFormField($from);
            }
        }
    }
}
