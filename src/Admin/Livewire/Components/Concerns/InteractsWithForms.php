<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Livewire\Exceptions\PropertyNotFoundException;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form as LittleFormAlias;

trait InteractsWithForms
{
    protected ?LittleFormAlias $_form = null;

    protected array $formDatas = [];

    protected bool $initBoot = true;

    protected array $datasRules;

    protected array $attributesRules;

    protected array $configParams = [];

    /**
     * @param  mixed  $property
     * @return mixed
     *
     * @throws PropertyNotFoundException
     */
    public function __get($property)
    {
        try {
            return parent::__get($property);
        } catch (PropertyNotFoundException $exception) {
            if ('form' === $property && $form = $this->getForm()) {
                return $form;
            }

            throw $exception;
        }
    }
}
