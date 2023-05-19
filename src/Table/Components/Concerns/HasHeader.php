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
        return $this->headers;
    }

    protected function headers(Header $header): static
    {
        $this->headers[] = $header;

        return $this;
    }
}
