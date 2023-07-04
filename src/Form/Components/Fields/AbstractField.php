<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Exception;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\View;

abstract class AbstractField implements Htmlable
{
    protected string $view = 'input';

    protected array $viewDatas = [];

    public function getFieldView(): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $this->view;
    }

    public function setViewDatas(string $key, mixed $viewDatas): void
    {
        $this->viewDatas[$key] = $viewDatas;
    }

    protected function getViewComponent(string $view): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $view;
    }

    public function getView(): string
    {
        if ( ! isset($this->view)) {
            throw new Exception('Class [' . static::class . '] extends [' . static::class . '] but does not have a [$view] property defined.');
        }

        return 'little-views::form-components.fields.' . $this->view;
    }

    public function render(): View
    {
        return view(
            $this->getView(),
            array_merge(
                ['attributes' => new ComponentAttributeBag()],
                $this->viewDatas,
            )
        );
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
