<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\BaseRowAction;

final class GroupAction implements Htmlable
{
    /** @param  BaseRowAction[]  $actions*/
    public function __construct(protected array $actions = [])
    {
    }

    /** @param  BaseRowAction[]  $actions*/
    public static function make(array $actions = []): static
    {
        foreach ($actions as $action) {
            $action->inGroupAction();
        }

        return new self($actions);
    }

    public function getActionByName(string $name): ?BaseRowAction
    {
        return collect($this->actions)->filter(/**
         * @param  BaseRowAction  $ra
         */ fn ($ra) => $ra->getName() === $name)->first();
    }

    public function render(): View
    {
        return view('little-views::action.group-action', ['actions' => $this->actions]);
    }

    public function toHtml()
    {
        return $this->render()->render();
    }

    /**
     * @return BaseRowAction[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }
}
