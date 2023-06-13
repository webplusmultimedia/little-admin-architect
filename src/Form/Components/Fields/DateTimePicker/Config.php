<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker;

use Carbon\Carbon;

class Config
{
    public function __construct(
        public string $lang = 'fr',
        public string $type = 'date',
        public null|Carbon $minDate = null,
        public null|Carbon $maxDate = null,
        public int $minTime = 7,
        public int $maxTime = 17,
        public int $intervalMinute = 17,
    ) {
    }
}
