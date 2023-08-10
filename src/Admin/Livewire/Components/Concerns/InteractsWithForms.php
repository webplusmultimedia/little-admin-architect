<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Illuminate\Support\Collection;
use Livewire\Exceptions\PropertyNotFoundException;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form as LittleFormAlias;

trait InteractsWithForms
{
    protected ?LittleFormAlias $_form = null;

    protected array $formDatas = [];

    protected ?string $pageRoute = null;

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

    public function getOptionUsing(string $name): array
    {
        $this->skipRender();
        /** @var Collection|array<null> $results */
        $results = $this->getOptionsUsing($name);
        $options = [];
        if ($results instanceof Collection) {
            return $results->map(fn ($value, $key) => ['value' => $key, 'label' => $value])->values()->toArray();
        }

        return $options;
    }

    /* public function getSearchResultUsing(string $name, string $term): array
     {
         $this->skipRender();
         $options = [];
         $results = $this->getSearchResultsUsing($name, $term);
         if ($results instanceof Collection) {
             $res = $results->map(fn ($value, $key) => ['value' => $key, 'label' => $value])->values()->toArray();

             return $res;
         }

         return $options;
     }*/
}
