<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Illuminate\Support\Collection;
use Livewire\Exceptions\PropertyNotFoundException;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form as LittleFormAlias;

trait InteractsWithForms
{
    protected LittleFormAlias|null $_form = null;

    protected array $formDatas = [];

    protected null|string $pageRoute = null;

    protected ?string $routeName = null;

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

            /*if ($property === 'modal') {
                return $this->getModalViewOnce();
            }*/

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

    public function getSearchResultUsing(string $name, string $term): array
    {
        $this->skipRender();
        $results = $this->getSearchResultsUsing($name, $term);
        $options = [];
        if ($results instanceof Collection) {
            return $results->map(fn ($value, $key) => ['value' => $key, 'label' => $value])->values()->toArray();
        }

        return $options;
    }
}
