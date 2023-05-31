<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

abstract class AbstractComponent extends Component
{
    protected string $viewPath;

    protected Field $field;

    public function __construct()
    {
        $this->viewPath = $this->setViewPath();
    }

    public function getConfig(): Field
    {
        return $this->field;
    }

    abstract protected function setViewPath(): string;

    abstract protected function setUp(Field $field): void;

    public function render(): View|Htmlable
    {
        return view('little-views::form-components.' . $this->viewPath);
    }
}
