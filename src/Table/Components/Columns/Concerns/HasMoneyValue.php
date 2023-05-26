<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

trait HasMoneyValue
{
    protected string $thousands_separator = ' ';

    protected string $decimal_separator = '.';

    protected int $nb_decimal = 2;

    public function euro(): static
    {
        $this->thousands_separator = ' ';
        $this->decimal_separator = ',';
        $this->nb_decimal = 2;
        $this->type = '€';
        $this->applyToValue();

        return $this;
    }

    public function dollar(): static
    {
        $this->thousands_separator = ',';
        $this->decimal_separator = '.';
        $this->nb_decimal = 2;
        $this->type = '$';
        $this->applyToValue();

        return $this;
    }

    public function customMoney(int $nb_decimal = 2, string $decimal_separator = '', string $thousands_separator = '', string $sign = '€'): static
    {
        $this->thousands_separator = ',';
        $this->decimal_separator = '.';
        $this->nb_decimal = 2;
        $this->type = '$';
        $this->applyToValue();

        return $this;
    }

    protected function applyToValue(): void
    {
        $this->value = function (AbstractColumn $column): string {
            if (is_float($column->record->{$column->name}) || is_int($column->record->{$column->name})) {
                return number_format($column->record->{$column->name}, $this->nb_decimal, $this->decimal_separator, $this->thousands_separator)
                    . ' ' . $this->type;
            }

            return $column->record->{$column->name};
        };
    }
}
