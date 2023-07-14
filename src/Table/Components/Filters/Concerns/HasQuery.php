<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasQuery
{
    protected ?Closure $query = null;

    public function query(Closure $query): static
    {
        $this->query = $query;

        return $this;
    }

    public function handleQuery(Builder $builder): Builder
    {
        if ( ! $this->query) {
            return $builder;
        }

        return app()->call($this->query, ['builder' => $builder, 'datas' => $this->getDatas()]);
    }

    protected function getDatas(): array
    {
        $datas = [];
        /** @var Field $formField */
        foreach ($this->getFormFields() as $formField) {
            $name = str($formField->getName())->before('.')->value();
            $datas[$name] = $formField->getState();
        }

        return $datas;
    }
}
