<?php

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

use Illuminate\Database\Eloquent\Model;

trait HasRecord
{
    protected ?Model $record = NULL;

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
