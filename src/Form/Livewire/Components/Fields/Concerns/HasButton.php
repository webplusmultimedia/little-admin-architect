<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasButton
{
    protected ?string $captionBtn = null;
    protected ?string $labelBtn = null;
    protected ?string $actionBtn = null;
    protected ?string $iconClassBtn = null;
    protected array $configBtn =[
        'class_success' =>'btn btn-success',
        'class_delete' =>'btn btn-error',
        'class_info' =>'btn btn-info',
        'class_warning' =>'btn btn-warning',
    ];
    public function caption(string $caption): static
    {
        $this->captionBtn = $caption;
        return $this;
    }
    public function getCaptionBtn(): ?string
    {
        return $this->captionBtn;
    }
}
