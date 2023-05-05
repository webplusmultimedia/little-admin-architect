<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

abstract class AbstractComponent extends Component
{
    protected string $viewPath;

    protected Field|AbstractLayout $field;

    public function __construct()
    {
        $this->viewPath = $this->setViewPath();
    }

    public function getConfig(): Field|AbstractLayout
    {
        return $this->field;
    }

    abstract protected function setViewPath(): string;
    abstract protected function setUp(Field|AbstractLayout $field): void;

    public function render(): View|Factory|Htmlable|Closure|string|Application
    {
        return view('little-views::admin-components.'.$this->viewPath);
    }
}
