<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;

trait HasHeader
{
    /**
     * @var array<int,Header> $headers
     */
    protected array $headers = [];


    /**
     * @return array<int,Header>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    protected function headers(Header $header): static
    {
        $this->headers[] = $header;

        return $this;
    }

}
