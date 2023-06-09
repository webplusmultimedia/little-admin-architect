<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Livewire\Exceptions\PropertyNotFoundException;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table;

trait InteractsWithTable
{
    /**
     * @param  mixed  $property
     * @return mixed|Table
     *
     * @throws PropertyNotFoundException
     */
    public function __get($property)
    {
        try {
            return parent::__get($property);
        } catch (PropertyNotFoundException $exception) {
            if ('table' === $property) {
                return $this->getTable();
            }

            throw $exception;
        }
    }
}
