<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Views;

use Illuminate\View\Component;

class Table extends Component
{

    public function __construct(
        protected \Webplusmultimedia\LittleAdminArchitect\Table\Components\Table $table
    ) {

    }

    public function getTable(): \Webplusmultimedia\LittleAdminArchitect\Table\Components\Table
    {
        return $this->table;
    }

    public function render()
    {
        return view('little-views::table-components.table');
    }
}
