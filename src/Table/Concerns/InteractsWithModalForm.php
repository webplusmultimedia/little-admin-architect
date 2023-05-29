<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Concerns;

trait InteractsWithModalForm
{
    protected string $modalPage = 'edit';

    public function showModalForm(mixed $key = null): void
    {
        if ( ! $key) {
            $this->modalPage = 'create';
        }
        $component = $this->table->getPage()::getComponentForPage($this->modalPage);
        $this->emit('open-modal-architect', $component, ['pageRoute' => $component, 'key' => $key], $this->id);
    }
}
