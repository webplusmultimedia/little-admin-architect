<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

trait HasColumns
{
    /**
     * @var AbstractColumn[]
     */
    protected array $columns = [];

    /**
     * @param  AbstractColumn[]  $columns
     */
    public function columns(array $columns): static
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @return AbstractColumn[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }
}
