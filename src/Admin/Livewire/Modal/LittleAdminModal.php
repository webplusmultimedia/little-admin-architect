<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Modal;

use Livewire\Component;

class LittleAdminModal extends Component
{
    public array $components = [];

    public string $name = 'admin-modal-component';

    public bool $isOpen = false;

    public null|string $activeComponent;

    public null|string $livewireTableId = null;

    protected $listeners = ['open-modal-architect' => 'openModal'];

    public function openModal(string $component, array $attributes = [], null|string $livewireId = null): void
    {
        $id = md5($component . serialize($attributes));
        $this->components[$id] = [
            'name' => $component,
            'attributes' => $attributes,
        ];
        $this->activeComponent = $id;
        $this->emit('adminShowModal', $id, $livewireId);
    }

    public function render()
    {
        return view('little-views::admin-components.components.modal');
    }
}
