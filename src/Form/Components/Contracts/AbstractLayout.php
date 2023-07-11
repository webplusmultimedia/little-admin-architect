<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts;

use Exception;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanInitDatasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasColSpan;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasSchema;

abstract class AbstractLayout implements Htmlable /*CanValidateValuesForRules, CanGetAttributesRules, CanInteractWithRules*/
{
    use CanInitDatasForm;
    use HasColSpan;
    use HasGridColumns;
    use HasSchema;
    use \Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasForm;

    protected string $view;

    protected ?Model $bind = null;

    public function __construct(
        public ?string $title = null,
        int $columns = 2,
    ) {
        $this->columns($columns);
        $this->afterMake();
        $this->setViewDatas($this->view, $this);
    }

    protected function afterMake(): void
    {

    }

    public function getBind(): ?Model
    {
        return $this->bind;
    }

    public function bind(Model $bind): static
    {
        $this->bind = $bind;

        return $this;
    }

    public function getWireKey(): string
    {
        $title = $this->title ?? Str::random(5);

        return (string) str($title)->append('-', str($title)->kebab());
    }

    public function getFieldView(): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $this->view;
    }

    protected function getViewComponent(string $view): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $view;
    }

    protected array $viewDatas = [];

    public function getView(): string
    {
        if ( ! isset($this->view)) {
            throw new Exception('Class [' . static::class . '] extends [' . static::class . '] but does not have a [$view] property defined.');
        }

        return 'little-views::form-components.layouts.' . $this->view;
    }

    public function setViewDatas(string $key, mixed $viewDatas): void
    {
        $this->viewDatas[$key] = $viewDatas;
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
