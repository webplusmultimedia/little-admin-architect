<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Views\Layouts\Contracts;

use Illuminate\View\Component;
use Illuminate\View\View;

abstract class AbstractComponent extends Component
{
    protected string $viewPath;

    public function render(): View
    {
        return view('little-views::table-components.' . $this->viewPath);
    }
}
