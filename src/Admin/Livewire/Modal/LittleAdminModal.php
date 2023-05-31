<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Modal;

use Livewire\Component;

class LittleAdminModal extends Component
{
    public array $components = [];

    public string $name = 'admin-modal-component';

    public bool $isOpen = false;

    public null|string $activeComponent = NULL;

    public null|string $livewireTableId = NULL;

    protected $listeners = ['open-modal-architect' => 'openModal'];

    public function openModal(string $component, array $attributes = [], null|string $livewireId = NULL): void
    {
        $id = md5($component . serialize($attributes));
        $this->components[ $id ] = [
            'name'       => $component,
            'attributes' => $attributes,
        ];
        $this->activeComponent = $id;
        $this->emit('adminShowModal', $id, $livewireId);
    }

    public function killComponent()
    {
        $this->skipRender();
        $this->reset('components', 'activeComponent', 'livewireTableId');
    }

    public function render()
    {
        return view('little-views::admin-components.components.modal');
    }
}
