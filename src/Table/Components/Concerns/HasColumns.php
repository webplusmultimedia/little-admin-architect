<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

trait HasColumns
{
    /**
     * @var array<int,AbstractColumn>
     */
    protected array $columns = [];

    /**
     * @param array<int,AbstractColumn> $columns
     *
     * @return static
     */
    public function columns(array $columns): static
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @return array<int,AbstractColumn>
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

}
