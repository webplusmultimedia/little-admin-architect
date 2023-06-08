<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait ContainMessageForComponent
{
    public function getMessagesContent(): array
    {
        return [
            'maxItemsMessage' => 5,
            'searchingMessage' => trans('little-admin-architect::form.select.searching-message'),
            'searchingNoMessage' => trans('little-admin-architect::form.select.searching-no-message'),
            'searchPrompt' => trans('little-admin-architect::form.select.search-prompt'),
            'placeholder' => trans('little-admin-architect::form.select.placeholder'),
        ];
    }
}
