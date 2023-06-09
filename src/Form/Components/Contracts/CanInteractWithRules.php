<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts;

interface CanInteractWithRules
{
    public function dehydrateRules(array $rules): array;
}
