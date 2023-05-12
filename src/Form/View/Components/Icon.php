<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

class Icon extends \Illuminate\View\Component
{
    public function __construct(
        protected string $name = 'loader'
    ) {

    }

    public function render()
    {
        return view("little-views::form-components.fields.icons.{$this->name}");
    }
}
