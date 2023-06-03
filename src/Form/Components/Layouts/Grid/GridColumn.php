<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Grid;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasSchema;

final class GridColumn
{
    use HasSchema;

    public function __construct(
        protected string $columns = 'col-span-full lg:col-span-6',
    ) {
    }

    public static function make(int $columns): static
    {
        return new GridColumn('col-span-full lg:col-span-' . $columns);
    }

    public function columns(int $columns): static
    {
        $this->columns = 'col-span-full lg:col-span-' . $columns;

        return $this;
    }

    public function getColumns(): string
    {
        return $this->columns;
    }
}
