<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasMinMaxLength;

final class Input extends Field
{
    use HasMinMaxLength;

    protected ?string $type = 'text';

    private null|int|float|string $step = null;

    private ?string $inputMode = null;

    public function type(string $type): static
    {
        if ('slug' === $type) {
            $this->disabled();
            $this->helperText('Merci de ne pas remplir');
            $type = 'text';
        }
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function email(): Input
    {
        $this->type = 'email';
        $this->addRules('email');

        return $this;
    }

    public function numeric(): Input
    {
        $this->type = 'number';
        $this->step(1);
        $this->inputMode = 'numeric';
        $this->addRules('numeric');

        return $this;
    }

    public function decimal(): Input
    {
        $this->type = 'number';
        $this->step = 'any';
        $this->inputMode = 'decimal';
        $this->addRules('numeric');

        return $this;
    }

    public function url(): Input
    {
        $this->type = 'url';
        $this->addRules('url');

        return $this;
    }

    public function confirmed(): Input
    {
        $this->addRules('confirmed');

        return $this;
    }

    public function password(): Input
    {
        $this->type = 'password';

        return $this;
    }

    public function step(int|float $step): Input
    {
        $this->step = $step;

        return $this;
    }

    public function getStep(): null|float|int|string
    {
        return $this->step;
    }

    public function inputMode(string $mode): Input
    {
        $this->inputMode = $mode;

        return $this;
    }

    public function getInputMode(): ?string
    {
        return $this->inputMode;
    }

    public function setUp(): void
    {
        $this->setViewDatas('field', $this);
    }
}
