<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal;

use Exception;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasCssClass;

class FormDialog implements Htmlable
{
    use HasCssClass;

    /**
     * @param  Field[]  $fields
     */
    public function __construct(
        public string $title,
        public string $actionLabel,
        public array $fields = [],
    ) {
        $this->color('primary');
    }

    /**
     * @param  Field[]  $fields
     */
    public static function make(string $title, string $actionLabel, array $fields): FormDialog
    {
        return new self(title: $title, actionLabel: $actionLabel, fields: $fields);
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
            'little-views::modal.form-dialog',
            [
                'title' => $this->title,
                'actionLabel' => $this->actionLabel,
                'btnClass' => $this->getClass(),
                'fields' => $this->fields,
            ]
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
