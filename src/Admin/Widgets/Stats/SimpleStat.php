<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 *
 * @category    Category
 *
 * @author      daniel
 *
 * @link        http://webplusm.net
 * Date: 30/10/2023 16:05
 */

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Widgets\Stats;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

class SimpleStat extends Component implements Htmlable
{
    protected ?string $description = null;

    /** @var scalar | Htmlable | Closure */
    protected $value;

    protected string | Htmlable $label;

    protected ?Action $button = null;

    /** @param  scalar | Htmlable | Closure  $value */
    public function __construct(string | Htmlable $label, $value)
    {
        $this->label($label);
        $this->value($value);
    }

    /** @param  scalar | Htmlable | Closure  $value */
    public static function make(string | Htmlable $label, $value): static
    {
        return app(static::class, ['label' => $label, 'value' => $value]);
    }

    public function render(): View
    {
        return $this->view('little-views::widgets.SimpleStat.simple-stat', $this->data());
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function button(string $label, string $function, string $color = null): static
    {
        $this->button = Action::make()->label($label)->wireClick($function);
        if ($color) {
            $this->button->color($color);
        }

        return $this;
    }

    public function label(string | Htmlable $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): Htmlable | string
    {
        return $this->label;
    }

    /**  @param  scalar | Htmlable | Closure  $value */
    public function value($value): static
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return scalar | Htmlable | Closure
     */
    public function getValue()
    {
        return value($this->value);
    }

    public function description(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getButton(): ?Action
    {
        if ( ! $this->button) {
            return null;
        }

        return $this->button;
    }
}
