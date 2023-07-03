<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasColor;

class ConfirmationDialog extends Component implements Htmlable
{
    use HasColor;

    public function __construct(
        public string $title,
        public string $subtitle,
        public string $actionLabel,
        string $btnClass,
    ) {
        //dd($btnClass);
        $this->color($btnClass);
    }

    public static function make(string $title, string $subtitle, string $actionLabel,string $btnClass): ConfirmationDialog
    {
        return new self(title: $title, subtitle: $subtitle, actionLabel: $actionLabel,btnClass: $btnClass,);
    }

    public function render(): View
    {
        return view(
            'little-views::modal.confirmation-dialog',
            ['title' => $this->title, 'subtitle' => $this->subtitle, 'actionLabel' => $this->actionLabel,'btnClass' => $this->getClass()]
        );
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
