<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Modal;

use Illuminate\View\View;
use Livewire\Component;

class LittleAdminModal extends Component
{
    public array $components = [];

    public string $name = 'admin-modal-component';

    public bool $isOpen = false;

    public ?string $activeComponent = null;

    public ?string $livewireTableId = null;

    public string $maxWidth = 'modal__large';

    /**
     * @var string[]
     */
    protected $listeners = ['open-modal-architect' => 'openModal'];

    public function openModal(string $component, array $attributes = [], string $livewireId = null): void
    {
        $id = md5($component . serialize($attributes));
        $this->components[$id] = [
            'name' => $component,
            'attributes' => $attributes,
        ];
        $this->activeComponent = $id;
        $this->emit('adminShowModal', $id, $livewireId);
    }

    public function killComponent(): void
    {
        $this->skipRender();
        $this->reset('components', 'activeComponent', 'livewireTableId');
    }

    public function render(): View
    {
        return view('little-views::admin-components.components.modal');
    }
}
