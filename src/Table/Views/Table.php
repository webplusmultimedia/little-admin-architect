<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Views;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\View;

class Table extends Component implements Htmlable
{
    public function __construct(
        protected \Webplusmultimedia\LittleAdminArchitect\Table\Components\Table $table
    ) {

    }

    public function getTable(): \Webplusmultimedia\LittleAdminArchitect\Table\Components\Table
    {
        return $this->table;
    }

    public function render(): View
    {
        return view('little-views::table-components.table');
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
