<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

use Illuminate\Database\Eloquent\Model;

trait HasRecord
{
    protected ?Model $record = null;

    public function record(Model $record): static
    {
        $this->record = $record;

        return $this;
    }

    public function getRecord(): ?Model
    {
        return $this->record;
    }
}
