<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Modal;

use Livewire\Component;

class LittleAdminModal extends Component
{
    public array $components = [];

    public string $name = 'admin-modal-component';

    public bool $isOpen = false;

    public null|string $activeComponent;

    protected $listeners = ['open-modal-architect'=>'openModal'];

    public function openModal(string $component, array $attributes = []): void
    {
        $id = md5($component.serialize($attributes));
        $this->components[$id] = [
            'name' => $component,
            'attributes' => $attributes,
        ];
        $this->activeComponent = $id;
        $this->emit('adminShowModal', $id);
    }

    public function render()
    {
        return view('little-views::admin-components.components.modal');
    }
}
