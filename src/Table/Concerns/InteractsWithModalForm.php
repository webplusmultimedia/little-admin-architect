<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Concerns;

trait InteractsWithModalForm
{
    public function showModalForm(mixed $key = null)
    {
        $component = $this->table->getPage()::getComponentForPage('edit');
        //$record = $this->table->fill($key);
        $this->emit('open-modal-architect',$component,['pageRoute' => $component, 'key'=>$key]);
    }
}
