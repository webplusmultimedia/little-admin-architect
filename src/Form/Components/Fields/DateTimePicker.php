<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\DateTime\HasConfigDateTime;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\DateTime\HasRangeDate;

class DateTimePicker extends Field
{
    use HasConfigDateTime;
    use HasRangeDate;

    protected string $view = 'date-time-picker-field';
}
