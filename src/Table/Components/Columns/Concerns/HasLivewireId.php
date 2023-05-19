<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

trait HasLivewireId
{
    protected string $livewireId;

    public function livewireId(string $id)
    {
        $this->livewireId = $id;
        return $this;
    }

    public function getLivewireId(): string
    {
        return $this->livewireId;
    }

    public function getWireId()
    {
        return str($this->getLabel())->slug()->prepend($this->getLivewireId(),'.')->append('.',$this->getRecord()->getKey());
    }
}
