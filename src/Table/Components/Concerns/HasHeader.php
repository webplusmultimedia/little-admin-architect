<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;

trait HasHeader
{
    /**
     * @var Header[]
     */
    protected array $headers = [];

    /**
     * @return Header[]
     */
    public function getHeaders(): array
    {
        foreach ($this->headers as $header) {
            $header->sortColumn(sortColumn: $this->getSortColumn())
                ->sortDirection(sortDirection: $this->getSortDirection());
        }

        return $this->headers;
    }

    protected function headers(Header $header): static
    {
        $this->headers[] = $header;

        return $this;
    }
}
