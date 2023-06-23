<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use BadMethodCallException;
use Illuminate\Support\Collection;
use Livewire\Exceptions\PropertyNotFoundException;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form as LittleFormAlias;

trait InteractsWithForms
{
    protected LittleFormAlias|null $_form = null;

    protected array $formDatas = [];

    protected null|string $pageRoute = null;

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

    public function __call($method, $params): void // @phpstan-ignore argument.type
    {

        try {
            parent::__call($method, $params);

            if ('hydrate' === $method /*|| str($method)->startsWith('hydrate')*/) {
                $this->form->hydrateState();

            }
            if ('dehydrate' === $method /*|| str($method)->startsWith('dehydrate')*/) {
                $this->form->dehydrateState();
            }
            /*if ('updating' === $method) {
                //dump('updating');
                $this->form->updating(...$params);
            }*/
            if ('updated' === $method) {
                //dump('updated');
                $this->form->updated(...$params);
            }
        } catch (BadMethodCallException $exception) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exist.', static::class, $method
            ));
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
