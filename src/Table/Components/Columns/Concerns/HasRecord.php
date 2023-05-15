<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasRecord
{
    protected Model $record;


    public function setRecord(Model $record): static
    {
        $this->record = $record;
        return $this;
    }

    public function getRecord(): Model
    {
        return $this->record;
    }

    public function getValue()
    {
        return $this->record->{$this->getName()};
    }

}
