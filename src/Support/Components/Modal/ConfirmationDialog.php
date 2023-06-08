<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\View;

class ConfirmationDialog extends Component implements Htmlable
{
    public function __construct(
        public string $title,
        public string $subtitle,
        public string $actionLabel
    ) {
    }

    public static function make(string $title, string $subtitle, string $actionLabel): ConfirmationDialog
    {
        return new self(title: $title, subtitle: $subtitle, actionLabel: $actionLabel);
    }

    public function render(): View
    {
        return view('little-views::modal.confirmation-dialog', ['title' => $this->title, 'subtitle' => $this->subtitle, 'actionLabel' => $this->actionLabel]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
