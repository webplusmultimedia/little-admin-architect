<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Livewire\Exceptions\PropertyNotFoundException;

trait InteractsWithTable
{
    public function __get($property)
    {
        try {
            return parent::__get($property);
        } catch (PropertyNotFoundException $exception) {
            if ('table' === $property) {
                return $this->getTable();
            }

            /*if ($property === 'modal') {
                return $this->getModalViewOnce();
            }*/

            throw $exception;
        }
    }
}
