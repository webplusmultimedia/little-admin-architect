<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Livewire\Exceptions\PropertyNotFoundException;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table;

trait InteractsWithTable
{
    public function __get($property)
    {
        try {
            return parent::__get($property);
        } catch (PropertyNotFoundException $exception) {
            /** @var Table $table */
            if ('table' === $property && $table = $this->getTable()) {
                return $table;
            }

            /*if ($property === 'modal') {
                return $this->getModalViewOnce();
            }*/

            throw $exception;
        }
    }
}
