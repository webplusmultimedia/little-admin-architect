<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker;

use Carbon\Carbon;

class ConfigDateTimePicker
{
    public function __construct(
        public string $lang = 'fr',
        public string $type = 'date',
        public ?Carbon $minDate = null,
        public ?Carbon $maxDate = null,
        public int $minTime = 7,
        public int $maxTime = 17,
        public int $intervalMinute = 5,
    ) {
    }
}
