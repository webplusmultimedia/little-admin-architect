<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait ContainMessageForComponent
{
    public function getMessagesContent(): array
    {
        return [
            'maxItemsMessage' => 5,
            'searchingMessage' =>  __('little-admin-architect::form.select.searching-message'),
            'searchingNoMessage' =>  __('little-admin-architect::form.select.searching-no-message'),
            'searchPrompt' => __('little-admin-architect::form.select.search-prompt'),
            'placeholder' => __('little-admin-architect::form.select.placeholder'),
        ];
    }
}
