<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Model;

trait HasRecord
{
    protected Model $record;
    protected string $type = 'text';
    protected Closure $value ;


    public function setRecord(Model $record): static
    {
        $this->record = $record;
        return $this;
    }

    public function getRecord(): Model
    {
        return $this->record;
    }

    public function getValue(): string
    {
        return call_user_func($this->value,$this);
    }

}
