<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasBelongToManyRelation
{
    protected ?Builder $relationshipBuilder = null;

    protected function getBuilderRelationship(): Builder
    {
        if (null === $this->relationshipBuilder) {
            try {

                if (HasMany::class === $this->getRelationType() or BelongsToMany::class === $this->getRelationType()) {
                    if (HasMany::class === $this->getRelationType()) {
                        $this->relationshipBuilder = $this->getInstanceRelationship()->getModel()->query();
                    }
                    if (BelongsToMany::class === $this->getRelationType()) {

                        $this->relationshipBuilder = $this->getInstanceRelationship()->getModel()->query();
                    }
                } else {
                    throw new Exception('Need only HasMany/BelongsToMany relationship on Select field [' . $this->name . ']');
                }

            } catch (Exception $e) {
                throw new Exception('Call to a non existing relationship [' . $this->relationship . '] on Select field [' . $this->name . ']');
            }

            if (is_callable($this->queryBuilderRelation)) {
                $this->relationshipBuilder = app()->call($this->queryBuilderRelation, ['builder' => $this->relationshipBuilder]);
            }
        }

        return $this->relationshipBuilder;
    }
}
