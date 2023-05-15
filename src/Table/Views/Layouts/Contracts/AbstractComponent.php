<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Views\Layouts\Contracts;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class AbstractComponent extends Component
{
    protected string $viewPath;


    public function render(): View|Htmlable
    {
        return view('little-views::table-components.' . $this->viewPath);
    }
}
