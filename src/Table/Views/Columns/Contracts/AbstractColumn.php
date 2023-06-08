<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Views\Columns\Contracts;

use Illuminate\View\Component;
use Illuminate\View\View;

abstract class AbstractColumn extends Component
{
    protected string $viewPath;

    abstract public function getColumn(): \Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

    public function render(): View
    {
        return view('little-views::table-components.columns.' . $this->viewPath);
    }
}
