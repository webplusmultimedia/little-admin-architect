<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasRecord
{
    protected array | Model | null $record = null;

    public function record(array | Model $record): static
    {
        $this->record = $record;

        return $this;
    }

    public function getRecord(): array | Model | null
    {
        return $this->record;
    }
}
