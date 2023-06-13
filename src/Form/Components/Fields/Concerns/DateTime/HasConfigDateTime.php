<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\DateTime;

use Carbon\Carbon;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker\Config;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\FieldException;

trait HasConfigDateTime
{
    protected ?Config $config = null;

    public function datetime(): static
    {
        $this->config->type = 'datetime';

        return $this;
    }

    public function range(): static
    {
        $this->config->type = 'range';

        return $this;
    }

    public function time(): static
    {
        $this->config->type = 'time';

        return $this;
    }

    public function minMaxDate(?Carbon $min = null, ?Carbon $max = null): static
    {
        $this->config->minDate = $min;
        $this->config->maxDate = $max;

        return $this;
    }

    public function minMaxTime(int $min = 7, int $max = 17): static
    {
        $this->config->minTime = $min;
        //@todo : test min and max time : if ($max>23 or $min>$max)
        $this->config->maxTime = $max;

        return $this;
    }

    public function intervalMinuteForTime(int $interval = 5): static
    {
        $this->config->intervalMinute = $interval;

        return $this;
    }

    public function lang(string $lang = 'fr-FR'): static
    {
        $this->config->lang = $lang;

        return $this;
    }

    public function getComponentValue(): array|Carbon|null
    {
        if ('range' !== $this->config->type) {
            return $this->getValue();
        }
        if ( ! $this->dateFrom) {
            throw new FieldException('Need dateFrom for range values');
        }

        return [$this->getRecord()->{$this->getName()}, $this->getRecord()->{$this->dateFrom}];
    }

    public function getConfig(): Config
    {
        if ( ! $this->config) {
            $this->config = new Config();
        }

        return $this->config;
    }
}
