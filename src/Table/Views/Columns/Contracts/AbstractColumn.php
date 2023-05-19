<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Views\Columns\Contracts;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class AbstractColumn extends Component
{
    protected string $viewPath;

    abstract public function getColumn();

    public function render(): View|Htmlable
    {
        return view('little-views::table-components.columns.' . $this->viewPath);
    }
}
