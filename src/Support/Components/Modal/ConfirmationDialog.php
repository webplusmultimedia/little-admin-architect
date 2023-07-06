<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal;

use Exception;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasCssClass;

class ConfirmationDialog extends Component implements Htmlable
{
    use HasCssClass;

    public function __construct(
        public string $title,
        public string $subtitle,
        public string $actionLabel,
        string $btnClass,
    ) {
        //dd($btnClass);
        $this->color($btnClass);
    }

    public static function make(string $title, string $subtitle, string $actionLabel, string $btnClass): ConfirmationDialog
    {
        return new self(title: $title, subtitle: $subtitle, actionLabel: $actionLabel, btnClass: $btnClass);
    }

    public function getClass(): string
    {
        $this->checkColor();
        /** @var string $color */
        $color = $this->color;
        if ($this->outline) {
            $this->btnStyle = 'btn-outline btn-outline-' . $color;
        } else {
            $this->btnStyle = 'btn-' . $color . ' text-white ';
        }
        if ($this->isBgTransparent) {
            $this->btnStyle = 'btn-transparent btn-text-' . $color;
        }

        $btnStyle = str($this->btnStyle);

        if ($this->roundedFull) {
            $btnStyle = $btnStyle->prepend('btn-rounded ');
        }
        if ($this->isSmall) {
            $btnStyle = $btnStyle->prepend('btn-small ');
        } else {
            $btnStyle = $btnStyle->prepend('btn-medium ');
        }

        return $btnStyle->value();
    }

    public function getColor(): string
    {
        $this->checkColor();

        return $this->color; // @phpstan-ignore-line
    }

    public function render(): View
    {
        return view(
            'little-views::modal.confirmation-dialog',
            ['title' => $this->title, 'subtitle' => $this->subtitle, 'actionLabel' => $this->actionLabel, 'btnClass' => $this->getClass()]
        );
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }

    private function checkColor(): void
    {
        if ( ! is_string($this->color)) {
            throw new Exception('$color must be a string value, ' . gettype($this->color) . ' provided.');
        }
    }
}
