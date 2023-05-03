<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasButton
{
    protected ?string $captionBtn = null;
    protected ?string $iconClassBtn = null;
    protected array $configBtn =[
        'class_post' =>'btn btn-success',
        'class_delete' =>'btn btn-error',
        'class_update' =>'btn btn-info',
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
