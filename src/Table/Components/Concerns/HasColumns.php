<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Fields\contracts\AbstractColumn;

trait HasColumns
{
    /**
     * @var array<int,AbstractColumn>
     */
    protected array $columns = [];

    public function columns(AbstractColumn $column): static
    {
        $this->columns[] = $column;
        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

}
