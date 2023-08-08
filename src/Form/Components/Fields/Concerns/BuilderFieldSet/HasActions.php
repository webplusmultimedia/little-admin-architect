<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\BuilderFieldSet;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

trait HasActions
{
    protected array $actions = [];

    /**
     * @return array{add: Action}
     */
    protected function getActions(): array
    {
        return [
            'add' => Action::make()
                ->icon('heroicon-o-plus-circle')
                ->small()
                ->label('add ' . $this->getLabel())
                ->wireClick("callAction('{$this->getStatePath()}','addFieldsToFieldSet')")
                ->roundedFull(),

            'delete' => Action::make()
                ->icon('heroicon-o-trash')
                ->small()
                ->danger()
                ->bgTransparent()
                ->roundedFull(),
            'reorder' => Action::make()
                ->icon('heroicon-o-chevron-up-down')
                ->small()
                ->bgTransparent()
                ->roundedFull()
                ->alpineDataClick(':class="hover:pointer-drag"'),
        ];
    }

    public function getActionByName(string $name): ?Action
    {
        if (isset($this->actions[$name])) {
            return $this->actions[$name];
        }

        return null;
    }
}
