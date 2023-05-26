<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Contracts;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts\AbstractLayout;

abstract class AbstractLayoutView extends Component
{
    protected string $viewPath;

    protected AbstractLayout $field;

    public function __construct()
    {
        $this->viewPath = $this->setViewPath();
    }

    public function getConfig(): AbstractLayout
    {
        return $this->field;
    }

    abstract protected function setViewPath(): string;

    abstract protected function setUp(AbstractLayout $field): void;

    public function render(): View|Htmlable
    {
        return view('little-views::form-components.' . $this->viewPath);
    }
}
