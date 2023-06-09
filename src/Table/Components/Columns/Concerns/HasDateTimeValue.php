<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

use Carbon\CarbonInterface;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\TextColumn;

trait HasDateTimeValue
{
    protected string $dateFormat = 'd/m/Y';

    public function date(string $format = 'd/m/Y'): static
    {
        $this->type = 'date';
        $this->dateFormat = $format;
        $this->value = function (TextColumn $column) {
            if ($column->record->{$column->name} instanceof CarbonInterface) {
                return $column->record->{$column->name}->format($column->dateFormat);
            }

            return $column->record->{$column->name};
        };

        return $this;
    }

    public function datetime(string $format = 'd/m/Y H:i'): static
    {
        $this->type = 'datetime';
        $this->dateFormat = $format;
        $this->value = function (TextColumn $column) {
            if ($column->record->{$column->name} instanceof CarbonInterface) {
                return $column->record->{$column->name}->format($column->dateFormat);
            }

            return $column->record->{$column->name};
        };

        return $this;
    }
}
