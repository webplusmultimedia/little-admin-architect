<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\DateTime;

use Carbon\Carbon;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker\ConfigDateTimePicker;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\FieldException;

trait HasConfigDateTime
{
    protected ?ConfigDateTimePicker $config = null;

    public function datetime(): static
    {
        $this->getConfig()->type = 'datetime';

        return $this;
    }

    public function time(): static
    {
        $this->getConfig()->type = 'time';

        return $this;
    }

    public function minMaxDate(?Carbon $min = null, ?Carbon $max = null): static
    {
        $this->getConfig()->minDate = $min;
        $this->getConfig()->maxDate = $max;

        return $this;
    }

    public function minMaxTime(int $min = 7, int $max = 17): static
    {
        $this->getConfig()->minTime = $min;
        //@todo : test min and max time : if ($max>23 or $min>$max)
        $this->getConfig()->maxTime = $max;

        return $this;
    }

    public function intervalMinuteForTime(int $interval = 5): static
    {
        $this->getConfig()->intervalMinute = $interval;

        return $this;
    }

    public function lang(string $lang = 'fr-FR'): static
    {
        $this->getConfig()->lang = $lang;

        return $this;
    }

    public function getComponentValue(): array|Carbon|string|null
    {
        $this->addRules('date');
        if ('range' !== $this->getConfig()->type) {
            return $this->getValue();
        }
        if ( ! $this->dateFrom) {
            throw new FieldException('Need dateFrom for range values (dateFrom("fieldName") method)');
        }
        $this->addRules('before:' . $this->getPrefix() . $this->dateFrom);
        if ( ! $this->getRecord()->{$this->getName()} or ! $this->getRecord()->{$this->dateFrom}) {
            return null;
        }

        return [$this->getRecord()->{$this->getName()}, $this->getRecord()->{$this->dateFrom}];
    }

    public function getConfig(): ConfigDateTimePicker
    {
        if ( ! $this->config) {
            $this->config = new ConfigDateTimePicker();
        }

        return $this->config;
    }
}
